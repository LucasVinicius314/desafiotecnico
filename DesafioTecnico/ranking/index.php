<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once('../config/RedeSocial.php');

// Instanciar a classe
$redeSocial = new RedeSocial();

// Montar e organizar a lista de todas as redes sociais usadas
$redes_sociais = $redeSocial->SelectDistinct();

$redes_sociais = OrdenarRedesSociais($redes_sociais);

// Retornar redes sociais
RetornarRedesSociais($redes_sociais);

// Funções
function OrdenarRedesSociais($redes_sociais)
{
    global $redeSocial;

    $temp_array = [];

    // Montar lista
    foreach ($redes_sociais as $value) $temp_array[$value->nome] = $redeSocial->SelectAmount($value->nome)[0]->{'count(*)'};

    // Organizar lista
    arsort($temp_array);

    return $temp_array;
}

function RetornarRedesSociais($redes_sociais)
{
    // Converter mês para integer
    foreach ($redes_sociais as $key => $value) $redes_sociais[$key] = (int) $value;

    echo json_encode($redes_sociais);
}
