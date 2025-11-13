<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/globalFunctions.php');
require_once(__DIR__ . '/functions.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = intval($_GET['id'] ?? 0);
$categoria = find_category_by_id($id);

if (!$categoria) {
    header('Location: index.php');
    exit;
}

$message = '';
$alertType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');

    if ($nome === '') {
        $message = 'O nome da categoria é obrigatório.';
        $alertType = 'danger';
    } else {
        $success = update_category($id, ['nome' => $nome]);
        if ($success) {
            $message = 'Categoria atualizada com sucesso!';
            $alertType = 'success';
            // Atualiza os dados para mostrar no formulário
            $categoria['nome'] = $nome;
        } else {
            $message = 'Erro ao atualizar a categoria.';
            $alertType = 'danger';
        }
    }
}

include(HEADER_TEMPLATE);
?>

<div class="container mt-5 pt-4">
    <h1 class="h3 mb-4">Editar Categoria</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?= $alertType; ?>"><?= htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="POST" class="w-50">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" id="nome" name="nome" class="form-control" required
                   value="<?= htmlspecialchars($categoria['nome_categoria']); ?>">
        </div>
        <button type="submit" class="btn btn-warning">Salvar Alterações</button>
        <a href="index.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
