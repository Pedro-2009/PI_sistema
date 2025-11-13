<?php
require_once(__DIR__ . '/../../init.php');
require_once(MODULES_PATH . '/comentarios/functions.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);
$comentario = find_comment_by_id($id);

if (!$comentario) {
    header('Location: index.php');
    exit;
}

// Confirma exclusão via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = delete_comment($id);
    if ($success) {
        header('Location: index.php?msg=Comentário excluído com sucesso');
        exit;
    } else {
        $error = "Erro ao excluir comentário.";
    }
}
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
    <h1 class="mb-4">Excluir Comentário</h1>
    <hr>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php else: ?>
        <div class="alert alert-warning">
            Tem certeza que deseja excluir o comentário de <strong><?= htmlspecialchars($comentario['autor_nome'] ?? 'Desconhecido') ?></strong>?
        </div>
    <?php endif; ?>

    <form method="POST">
        <button type="submit" class="btn btn-danger">Sim, excluir</button>
        <a href="index.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
