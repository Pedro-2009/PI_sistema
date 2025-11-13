<?php
require_once(__DIR__ . '/../../config.php');
require_once(MODULES_PATH . '/categorias/functions.php');

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);
$categoria = find_category_by_id($id);

if (!$categoria) {
    $message = "Categoria não encontrada.";
    $alertType = "warning";
    header("Location: index.php?message=" . urlencode($message) . "&alert=" . $alertType);
    exit;
}

include(HEADER_TEMPLATE);
?>

<div class="container py-5">
    <h2 class="mb-4">Detalhes da Categoria</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($categoria['nome']); ?></h5>
            <p class="card-text"><strong>ID:</strong> <?= $categoria['id']; ?></p>
            <p class="card-text"><strong>Criado em:</strong> <?= $categoria['criado_em']; ?></p>
            <a href="edit.php?id=<?= $categoria['id']; ?>" class="btn btn-primary me-2">Editar</a>
            <a href="delete.php?id=<?= $categoria['id']; ?>" class="btn btn-danger" 
               onclick="return confirm('Deseja realmente deletar esta categoria?');">Deletar</a>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
