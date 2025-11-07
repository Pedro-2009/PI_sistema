<?php
require_once('../../init.php');
require_once('functions.php');
session_start();

requireRole(['admin', 'funcionario', 'escritor']);

$id = $_GET['id'];
$categoria = getCategoria($id);

if (!$categoria) {
    header("Location: index.php");
}
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container mt-4">
    <h2>Detalhes da Categoria</h2>

    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> <?= $categoria['id'] ?></li>
        <li class="list-group-item"><strong>Categoria:</strong> <?= $categoria['nome_categoria'] ?></li>
    </ul>

    <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
</div>

<?php include(FOOTER_TEMPLATE); ?>
