<?php

/**
 * Formatar dados para debug
 *
 * @param array ...$args
 */
function dd(... $args) {
    echo "<pre>";
    var_dump($args);
    die();
}

/**
 * Formatar data para salvar no banco
 *
 * @param $data
 * @return false|string
 */
function formatarDataHoraBD($data) {
    return date("Y-m-d H:i:s", strtotime( str_replace("/", "-", $data) ) );
}

/**
 * Formatar data hora BR
 *
 * @param $data
 * @param bool $mostrarSegundos
 * @param bool $possuiSeparador
 * @param string $separador
 * @return false|string
 */
function formatarDataHoraBr($data, $mostrarSegundos = true, $possuiSeparador = false, $separador = "") {
    $format = "d/m/Y" . ($possuiSeparador ? " $separador " : " ") . "H:i" . ($mostrarSegundos ? ":s" : "");
    return $data ? date($format, strtotime( str_replace("/", "-", $data) ) ) : $data;
}

/**
 * Formatar valor numérico para salvar no banco
 *
 * @param $valor
 * @return float
 */
function formatarFloatBD($valor) {
    return (float) str_replace(",", ".", str_replace(".", "", $valor));
}

/**
 * Formatar valor BR
 *
 * @param $valor
 * @return string
 */
function formatarValorBr($valor) {
    return !is_null($valor) ? number_format($valor, 2, ",", ".") : $valor;
}

/**
 * Calcular valor de um percentual sobre um valor (Ex.: 20% de 1000 = 200).
 *
 * @param $total
 * @param $perc
 * @return float|int
 */
function calcularPercentualSobreValor($total, $perc) {
    try {
        return ($total * $perc) / 100;
    } catch (\Exception $e) {
        return 0;
    }
}