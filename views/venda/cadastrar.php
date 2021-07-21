<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Nova Venda');

use \App\Entity\Produto;
use \App\Entity\Venda;

$obVenda = new Venda;

//VALIDAÇÃO DO POST
if (isset($_POST['dh_cadastro'], $_POST['valor_total_compra'], $_POST['produtos'])) {
    $obVenda->fillAndSave($_POST);

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../theme/header.php';

$cadastro = true;
$produtos = (new Produto)->get(null, 'nome');
include_once __DIR__ .'/formulario.php';

include_once __DIR__ . '/../theme/footer.php';