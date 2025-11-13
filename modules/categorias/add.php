<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/globalFunctions.php');
require_once(__DIR__ . '/functions.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include(HEADER_TEMPLATE);

$message = '';
$alertType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');

    if ($nome === '') {
        $message = 'O nome da categoria é obrigatório.';
        $alertType = 'danger';
    } else {
        $success = add_category(['nome' => $nome]);
        if ($success) {
            $message = 'Categoria adicionada com sucesso!';
            $alertType = 'success';
        } else {
            $message = 'Erro ao adicionar a categoria.';
            $alertType = 'danger';
        }
    }
}
?>

<div class="container mt-5 pt-4">
    <h1 class="h3 mb-4">Adicionar Categoria</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?= $alertType; ?>"><?= htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="POST" class="w-50">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" id="nome" name="nome" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
        <a href="index.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
