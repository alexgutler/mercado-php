<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2><?=TITLE?></h2>

    <form method="post">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?=$obTipo->nome?>" required maxlength="150">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" maxlength="255"><?=$obTipo->descricao?></textarea>
        </div>

        <div class="form-group">
            <label for="percentual_imposto">Percentual Imposto</label>
            <input type="number" class="form-control" id="percentual_imposto" name="percentual_imposto" value="<?=$obTipo->percentual_imposto?>"
                   min="0" required>
        </div>

        <div class="form-group">
            <label>Status</label>
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

        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>
</main>