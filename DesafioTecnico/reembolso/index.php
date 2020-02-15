<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once('../config/VerbaIndenizatoria.php');

// Instanciar a classe
$verbaIndenizatoria = new VerbaIndenizatoria();

// Montar e organizar a lista de verbas
$verbas = $verbaIndenizatoria->Select();

$verbas = Ordenar_Verbas($verbas);

// Retornar verbas
RetornarVerbas($verbas);

// Funções
function Ordenar_Verbas($verbas)
{
    global $verbaIndenizatoria;

    $temp_array = [];

    // Montar lista
    foreach ($verbas as $value) array_push($temp_array, array('idDeputado' => (int) $value->idDeputado, 'nome' => $verbaIndenizatoria->SelectName($value->idDeputado)[0]->nome, 'quantidade' => (int) $verbaIndenizatoria->SelectAmount($value->idDeputado)[0]->{'count(*)'}));

    // Organizar lista
    usort($temp_array, function ($a, $b) {

        return $a['quantidade'] < $b['quantidade'];

    });

    return $temp_array;
}

function RetornarVerbas($verbas)
{
    // Selecionar os primeiros 5 itens da lista
    $verbas = array_slice($verbas, 0, 5);

    echo json_encode($verbas);
}
