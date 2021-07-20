<?php
    use App\Entity\Produto;

    $registros = (new Produto())->getComTipo(null, 'nome');

    $mensagem = '';
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
        } elseif ($_GET['status'] == 'error') {
            $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
        }
    }

    $resultados = '';
    foreach ($registros as $registro) {
        $resultados .= '<tr>
                          <td>'.$registro->id.'</td>
                          <td>'.$registro->nome.'</td>
                          <td>'.$registro->descricao.'</td>
                          <td>'.($registro->tipoProduto ? $registro->tipoProduto->nome : '').'</td>
                          <td>'.($registro->ativo ? 'Ativo' : 'Inativo').'</td>
                          <td>'.date('d/m/Y H:i:s', strtotime($registro->dh_cadastro)).'</td>
                          <td>
                            <a href="editar.php?id='.$registro->id.'" class="btn btn-warning btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="excluir.php?id='.$registro->id.'" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>';
    }

    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                         <td colspan="7" class="text-center">
                                                            Nenhum registro encontrado
                                                         </td>
                                                       </tr>';

?>

<main>
    <h3 class="margin-top-0"><?=TITLE?></h3>

    <?=$mensagem?>

    <section class="margin-bottom-15">
        <a href="cadastrar.php">
            <button class="btn btn-success">
                <i class="fa fa-plus-circle"></i> Adicionar novo
            </button>
        </a>
    </section>

    <section>
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th>Cadastrado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultados?>
            </tbody>
        </table>
    </section>
</main>