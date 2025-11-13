<?php
require_once(__DIR__ . '/../../init.php');
// requireAccess([]); // removido pois não existe

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

// Processa o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conteudo = trim($_POST['conteudo'] ?? '');
    
    if (!empty($conteudo)) {
        $success = update_comment($id, ['conteudo' => $conteudo]);
        if ($success) {
            header('Location: index.php?msg=Comentário atualizado com sucesso');
            exit;
        } else {
            $error = "Erro ao atualizar comentário.";
        }
    } else {
        $error = "O conteúdo não pode ficar vazio.";
    }
}
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
    <h1 class="mb-4">Editar Comentário</h1>
    <hr>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Autor</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($comentario['autor_nome'] ?? 'Desconhecido') ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Notícia</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($comentario['noticia_titulo'] ?? 'Sem notícia') ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Conteúdo</label>
            <textarea name="conteudo" class="form-control" rows="5"><?= htmlspecialchars($comentario['conteudo']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-warning">Salvar Alterações</button>
        <a href="index.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
