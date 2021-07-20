<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Cadastrar Produto');

use \App\Entity\Produto;
use \App\Entity\TipoProduto;

$obProduto = new Produto;

//VALIDAÇÃO DO POST
if (isset($_POST['nome'], $_POST['tipo_id'], $_POST['ativo'])){
    $obProduto->nome = $_POST['nome'];
    $obProduto->descricao = $_POST['descricao'];
    $obProduto->tipo_id = $_POST['tipo_id'];
    $obProduto->ativo = $_POST['ativo'];
    $obProduto->create();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../theme/header.php';

$cadastro = true;
$tiposProduto = (new TipoProduto)->get('ativo=1', 'nome');
include_once __DIR__ .'/formulario.php';

include_once __DIR__ . '/../theme/footer.php';