<?php
require_once('../../init.php');
require_once('functions.php');
session_start();

requireRole(['admin', 'funcionario']);

$id = $_GET['id'];
$categoria = getCategoria($id);

if (!$categoria) {
    header("Location: index.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateCategoria($id);
}
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container mt-4">
    <h2>Editar Categoria</h2>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nome da Categoria</label>
            <input type="text" name="nome_categoria" class="form-control"
                   value="<?= $categoria['nome_categoria'] ?>" required>
        </div>

        <button class="btn btn-warning">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
