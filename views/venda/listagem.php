<?php
    use App\Entity\Venda;

    $registros = (new Venda())->get(null,'dh_cadastro');

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
                          <td>'.(formatarValorBr($registro->valor_total_compra)).'</td>
                          <td>'.(formatarValorBr($registro->valor_total_imposto)).'</td>
                          <td>'.$registro->observacoes.'</td>
                          <td>'.(formatarDataHoraBr($registro->dh_cadastro)).'</td>
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
                                                         <td colspan="5" class="text-center">
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
                <i class="fas fa-shopping-bag"></i> Nova venda
            </button>
        </a>
    </section>

    <section>
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor Total</th>
                    <th>Valor Imposto</th>
                    <th>Observações</th>
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