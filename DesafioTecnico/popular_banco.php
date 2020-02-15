<?php

require_once('config/Deputado.php');
require_once('config/RedeSocial.php');
require_once('config/VerbaIndenizatoria.php');

// Instanciar as classes
$deputado = new Deputado();
$redeSocial = new RedeSocial();
$verbaIndenizatoria = new VerbaIndenizatoria();

// Recuperar informações das redes sociais através da API usando curl
$redes_sociais_response = RedesSociaisRequest();

// Inserir informações dos deputados e redes sociais no banco de dados
InserirDeputado($redes_sociais_response);

// Inserir informações das verbas no banco de dados para os meses 4 e 5
InserirVerbas([4, 5]);

// Funções
function InserirVerbas($meses)
{
    global $deputado;
    global $verbaIndenizatoria;

    $lista_URL = GerarListaURL($meses);

    // Recuperar informações das verbas através da API usando curl
    $verbas_response = MultiRequest($lista_URL);

    // Inserir informações das verbas no banco de dados
    foreach ($lista_URL as $key => $value) {

        try {
            // Decodificar dados
            $conteudo = json_decode(curl_multi_getcontent($verbas_response[$key]['curl']));

            if ($conteudo == null) continue;

            foreach ($conteudo->list as $value) {

                if ($value->idDeputado == null) continue;

                // Inserir verbas no banco
                $verbaIndenizatoria->Insert($deputado->Select($value->idDeputado)[0]->nome, $verbas_response[$key]['mes'], $verbas_response[$key]['id']);
            }
        } catch (Exception $ex) {

            echo ($ex->Message);
        }
    }
}

function RedesSociaisRequest()
{
    // Iniciar curl
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://dadosabertos.almg.gov.br/ws/deputados/lista_telefonica?formato=json",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => "GET"
    ));

    // Executar curl
    $redes_sociais_response = curl_exec($curl);

    curl_close($curl);

    return json_decode($redes_sociais_response);
}

function MultiRequest($lista_URL)
{
    $temp_array = [];

    // Iniciar curl
    foreach ($lista_URL as $key => $value) {

        array_push($temp_array, array(
            'curl' => curl_init($value['url']),
            'id' => $value['id'],
            'mes' => $value['mes']
        ));

        curl_setopt($temp_array[$key]['curl'], CURLOPT_RETURNTRANSFER, true);
    }

    // Preparar curl_multi
    $multi_URL = curl_multi_init();

    foreach ($temp_array as $value) curl_multi_add_handle($multi_URL, $value['curl']);

    $running = null;

    // Executar curl
    do {
        curl_multi_exec($multi_URL, $running);
    } while ($running);

    foreach ($temp_array as $key => $value) curl_multi_remove_handle($multi_URL, $value['curl']);

    curl_multi_close($multi_URL);

    return $temp_array;
}

function InserirDeputado($redes_sociais_response)
{
    global $deputado, $redeSocial;

    foreach ($redes_sociais_response->list as $value) {

        $deputado->Insert($value->id, $value->nome, $value->nomeServidor, $value->partido, $value->email);

        foreach ($value->redesSociais as $rede_social) {

            $redeSocial->Insert($rede_social->redeSocial->nome, $rede_social->redeSocial->url, $value->id);
        }
    }
}

function GerarListaURL($meses)
{
    global $deputado;

    // Retornar lista de todos os deputados
    $deputados = $deputado->SelectAll();

    $temp_array = [];

    // Montar lista de links
    foreach ($meses as $value1) {

        foreach ($deputados as $value2) {

            array_push($temp_array, array(
                'url' => 'http://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/legislatura_atual/deputados/' . $value2->id . '/2019' . '/' . $value1 . '?formato=json',
                'id' => $value2->id,
                'mes' => $value1
            ));
        }
    }

    return $temp_array;
}
