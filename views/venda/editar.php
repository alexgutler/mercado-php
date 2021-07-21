<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Editar Produto');

use \App\Entity\Produto;
use \App\Entity\TipoProduto;

//VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

//BUSCAR O REGISTRO
$obProduto = (new Produto)->find($_GET['id']);

//VALIDAÇÃO DO REGISTRO
if (!$obProduto instanceof Produto){
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['nome'], $_POST['tipo_id'], $_POST['ativo'])) {

    $obProduto->nome = $_POST['nome'];
    $obProduto->descricao = $_POST['descricao'];
    $obProduto->tipo_id = $_POST['tipo_id'];
    $obProduto->ativo = $_POST['ativo'];
    $obProduto->update();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../theme/header.php';

$cadastro = false;
$tiposProduto = (new TipoProduto)->get('ativo=true', 'nome');
include_once __DIR__ .'/formulario.php';

include_once __DIR__ . '/../theme/footer.php';