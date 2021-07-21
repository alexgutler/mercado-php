<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Editar Venda');

use \App\Entity\Produto;
use \App\Entity\Venda;

//VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

//BUSCAR O REGISTRO
$obVenda = (new Venda)->find($_GET['id'], true);

//VALIDAÇÃO DO REGISTRO
if (!$obVenda instanceof Venda){
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['dh_cadastro'], $_POST['valor_total_compra'], $_POST['produtos'])) {
    $obVenda->fillAndSave($_POST);

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../theme/header.php';

$cadastro = false;
$produtos = (new Produto)->get(null, 'nome');
include_once __DIR__ .'/formulario.php';

include_once __DIR__ . '/../theme/footer.php';