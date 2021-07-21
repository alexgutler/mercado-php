<main>
    <h2><?=TITLE?></h2>

    <form method="post">
        <div class="form-group">
            <label for="dh_cadastro">Data/Hora</label>
            <input type="text" class="form-control" id="dh_cadastro" name="dh_cadastro" readonly required
                   value="<?=($obProduto->dh_cadastro ? date('d/m/Y H:i:s', strtotime($obProduto->dh_cadastro)) : date('d/m/Y H:i:s'))?>">
        </div>

        <div class="form-group">
            <label for="observacoes">Observações</label>
            <textarea class="form-control" id="observacoes" name="observacoes" rows="4" maxlength="255"><?=$obProduto->observacoes?></textarea>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fas fa-box margin-right-5"></i> Produtos
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered margin-bottom-10">
                        <thead>
                            <tr>
                                <th> Produto <i class="fa fa-asterisk fa-required"></i> </th>
                                <th> Qtde <i class="fa fa-asterisk fa-required"></i> </th>
                                <th> Vlr unit <i class="fa fa-asterisk fa-required"></i> </th>
                                <th> Subtotal </th>
                                <th class="text-center"> Remover </th>
                            </tr>
                        </thead>
                        <tbody id="produtos">

                            <?php
                                $opcoesSelectProdutos = '';
                                foreach ($produtos as $produto) {
                                    $opcoesSelectProdutos .= '<option value="' . $produto->id . '">' . $produto->nome . '</option>';
                                }
                            ?>

                            <tr id="produtos-1" class="linha-produto">
                                <td>
                                    <select class="form-control produto" id="produtos_produto-1" name="produtos[1][produto_id]" required>
                                        <option value="">Selecione...</option>
                                        <?=$opcoesSelectProdutos?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control quantidade mascara-num_int" id="produtos_quantidade-1"
                                           name="produtos[1][quantidade]" value="" min="1" step="1" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control valor_unitario mascara-valor" id="produtos_valor_unitario-1"
                                           name="produtos[1][valor_unitario]" value="" min=".01" step=".01" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control valor_total mascara-valor" id="produtos_valor_total-1"
                                           name="produtos[1][valor_total]" value="" min=".01" step=".01" required readonly>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btnRemoverProduto btn btn-xs btn-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- /.table-responsive -->
            </div> <!-- /.panel-body -->
            <div class="panel-footer">
                <button id="btnAdicionarProduto" type="button" class="btn btn-default text-success">
                    <i class="text-success fa fa-plus-circle margin-right-5"></i>
                    <span class="text-success">Adicionar produto</span>
                </button>
            </div>
        </div> <!-- /.panel -->


        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check margin-right-5"></i> Salvar
                </button>
                <a href="index.php" class="btn btn-default">
                    <i class="fas fa-chevron-left margin-right-5"></i> Voltar
                </a>
            </div>
            <div class="col-lg-6 text-right">
                <span>Campos com <i class="fa fa-asterisk fa-required"></i> são obrigatórios.</span>
            </div>
        </div>
    </form>
</main>