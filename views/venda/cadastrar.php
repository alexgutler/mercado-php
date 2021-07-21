<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Nova Venda');

use \App\Entity\Produto;
use \App\Entity\Venda;

$obVenda = new Venda;

//VALIDAÇÃO DO POST
if (isset($_POST['dh_cadastro'], $_POST['valor_total_compra'], $_POST['produtos'])) {
    dd($_POST['produtos'], $_POST['dh_cadastro']);

    $obVenda->nome = $_POST['nome'];
    $obVenda->descricao = $_POST['descricao'];
    $obVenda->tipo_id = $_POST['tipo_id'];
    $obVenda->ativo = $_POST['ativo'];
    $obVenda->create();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../theme/header.php';

$cadastro = true;
$produtos = (new Produto)->get(null, 'nome');
include_once __DIR__ .'/formulario.php';

include_once __DIR__ . '/../theme/footer.php';