<main>
    <h2><?=TITLE?></h2>

    <form method="post">
        <div class="form-group">
            <label for="dh_cadastro">Cadastro</label>
            <input type="text" class="form-control" id="dh_cadastro" name="dh_cadastro" readonly required
                   value="<?=($obVenda->dh_cadastro ? formatarDataHoraBr($obVenda->dh_cadastro) : date('d/m/Y H:i:s'))?>">
        </div>

        <div class="form-group">
            <label for="valor_total_compra">Valor Total</label>
            <div class="input-group">
                <div class="input-group-addon"> <i class="fa fa-dollar-sign"></i> </div>
                <input type="text" class="form-control mascara-valor valid" id="valor_total_compra" name="valor_total_compra"
                       value="<?=formatarValorBr($obVenda->valor_total_compra ?? "0")?>"
                       readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="observacoes">Observações</label>
            <textarea class="form-control" id="observacoes" name="observacoes" rows="4" maxlength="255"><?=$obVenda->observacoes?></textarea>
        </div>

        <div class="panel panel-default panel-produtos_venda">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fas fa-box margin-right-5"></i> Produtos
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive" style="color: #FFF;">
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
                                $linhasProduto = '';
                                if ($cadastro) {
                                    $iProd = 1;
                                    $linhasProduto .= include '_linha-produto.php';
                                } else {
                                    foreach ($obVenda->produtosVenda as $prodVenda) {
                                        $iProd = $prodVenda->id;
                                        $linhasProduto .= include '_linha-produto.php';
                                    }
                                }
                            ?>
                            <?=$linhasProduto?>
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

        <input type="hidden" name="cadastrando" value="<?=($cadastro?1:0)?>">

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