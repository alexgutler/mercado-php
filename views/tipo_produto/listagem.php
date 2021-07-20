<?php
    use App\Entity\TipoProduto;

    $registros = (new TipoProduto())->get();

    $mensagem = '';
    if(isset($_GET['status'])){
        switch ($_GET['status']) {
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
                break;

            case 'error':
                $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
                break;
        }
    }

    $resultados = '';
    foreach($registros as $registro){
        $resultados .= '<tr>
                          <td>'.$registro->id.'</td>
                          <td>'.$registro->nome.'</td>
                          <td>'.$registro->descricao.'</td>
                          <td>'.(number_format($registro->percentual_imposto, 2, ',', '.')).'</td>
                          <td>'.($registro->ativo ? 'Ativo' : 'Inativo').'</td>
                          <td>'.date('d/m/Y H:i:s', strtotime($registro->dh_cadastro)).'</td>
                          <td>
                            <a href="editar.php?id='.$registro->id.'">
                              <button type="button" class="btn btn-primary">Editar</button>
                            </a>
                            <a href="excluir.php?id='.$registro->id.'">
                              <button type="button" class="btn btn-danger">Excluir</button>
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
    <?=$mensagem?>

    <section class="margin-bottom-15">
        <a href="cadastrar.php">
            <button class="btn btn-success">
                <i class="fa fa-plus-circle"></i> Adicionar novo
            </button>
        </a>
    </section>

    <section>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Percentual Imposto (%)</th>
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