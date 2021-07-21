<main>
    <h2><?=TITLE?></h2>

    <form method="post">
        <div class="form-group">
            <p>
                Você deseja realmente excluir o registro
                <strong>"ID: <?=$obVenda->id?>"</strong>?
            </p>
        </div>

        <div class="form-group">
            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
            <a href="index.php" class="btn btn-default">Cancelar</a>
        </div>
    </form>
</main>