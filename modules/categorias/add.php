<?php
require_once('../../init.php');
require_once('functions.php');
session_start();

requireRole(['admin', 'funcionario']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addCategoria();
}
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container mt-4">
    <h2>Cadastrar Categoria</h2>

    <form method="post">

        <div class="mb-3">
            <label class="form-label">Nome da Categoria</label>
            <input type="text" name="nome_categoria" class="form-control" required>
        </div>

        <button class="btn btn-success">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
    