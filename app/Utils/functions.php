<?php

function dd(... $args) {
    echo "<pre>";
    var_dump($args);
    die();
}

function formatarDataHoraMySQL($data) {
    return date("Y-m-d H:i:s", strtotime( str_replace("/", "-", $data) ) );
}

function formatarDataHoraBr($data, $mostrarSegundos = true, $possuiSeparador = false, $separador = "")
{
    $format = "d/m/Y" . ($possuiSeparador ? " $separador " : " ") . "H:i" . ($mostrarSegundos ? ":s" : "");
    return $data ? date($format, strtotime( str_replace("/", "-", $data) ) ) : $data;
}

function formatarFloatMySQL($valor)
{
    return (float) str_replace(",", ".", str_replace(".", "", $valor));
}

function formatarValorBr($valor)
{
    return !is_null($valor) ? number_format($valor, 2, ",", ".") : $valor;
}