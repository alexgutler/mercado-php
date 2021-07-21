<main>
    <h2><?=TITLE?></h2>

    <form method="post">
        <div class="form-group">
            <label for="nome">Nome <i class="fa fa-asterisk fa-required"></i></label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?=$obProduto->nome?>" required maxlength="150">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" maxlength="255"><?=$obProduto->descricao?></textarea>
        </div>

        <?php
            $opcoesSelectTipos = '';
            foreach ($tiposProduto as $tipo) {
                $opcoesSelectTipos .= '<option value="' . $tipo->id . '" ' .
                                            (!$cadastro && $obProduto->tipo_id == $tipo->id ? 'selected' : '') . '>' . $tipo->nome . '</option>';
            }
        ?>
        <div class="form-group">
            <label for="tipo">Tipo <i class="fa fa-asterisk fa-required"></i> </label>
            <select class="form-control" id="tipo" name="tipo_id" required>
                <option value="" <?=$cadastro ? 'selected' : ''?>>Selecione...</option>
                <?=$opcoesSelectTipos?>
            </select>
        </div>

        <div class="form-group">
            <label>Status <i class="fa fa-asterisk fa-required"></i></label>
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="1" checked> Ativo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="0" <?=(!$cadastro && !$obProduto->ativo) ? 'checked' : ''?>> Inativo
                    </label>
                </div>
            </div>
        </div>

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