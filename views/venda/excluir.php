<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Excluir Produto');

use \App\Entity\Produto;

//VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA O REGISTRO
$obProduto = (new Produto)->find($_GET['id']);

//VALIDAÇÃO DO REGISTRO
if (!$obProduto instanceof Produto){
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['excluir'])) {

    $obProduto->delete();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../theme/header.php';

include_once __DIR__ .'/confirmar-exclusao.php';

include_once __DIR__ . '/../theme/footer.php';