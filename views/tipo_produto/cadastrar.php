<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Cadastrar Tipo de Produto');

use \App\Entity\TipoProduto;
$obTipo = new TipoProduto;

//VALIDAÇÃO DO POST
if (isset($_POST['nome'], $_POST['percentual_imposto'], $_POST['ativo'])){
    $obTipo->fill($_POST)->create();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../theme/header.php';

$cadastro = true;
include_once __DIR__ .'/formulario.php';

include_once __DIR__ . '/../theme/footer.php';