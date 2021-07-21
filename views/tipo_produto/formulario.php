<main>
    <h2><?=TITLE?></h2>

    <form method="post">
        <div class="form-group">
            <label for="nome">Nome <i class="fa fa-asterisk fa-required"></i></label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?=$obTipo->nome?>" required maxlength="150">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" maxlength="255"><?=$obTipo->descricao?></textarea>
        </div>

        <div class="form-group">
            <label for="percentual_imposto">Percentual Imposto <i class="fa fa-asterisk fa-required"></i></label>
            <input type="text" class="form-control mascara-valor" id="percentual_imposto" name="percentual_imposto"
                   value="<?=formatarValorBr($obTipo->percentual_imposto ?? "0,00")?>" min="0" step=".01" required>
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
                        <input type="radio" name="ativo" value="0" <?=(!$cadastro && !$obTipo->ativo) ? 'checked' : ''?>> Inativo
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