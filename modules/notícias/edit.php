<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/globalFunctions.php');
require_once(INC_PATH . '/database.php');

if (session_status() === PHP_SESSION_NONE) session_start();

$conn = open_database();
if (!$conn) {
    echo "<div class='alert alert-danger text-center'>Erro ao conectar ao banco.</div>";
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "<div class='container py-5 text-center'><div class='alert alert-danger'>ID inválido.</div></div>";
    include(FOOTER_TEMPLATE);
    exit;
}

require_once(__DIR__ . '/functions.php');
$noticia = find_news_by_id($id);

if (!$noticia) {
    echo "<div class='container py-5 text-center'><div class='alert alert-danger'>Notícia não encontrada.</div></div>";
    include(FOOTER_TEMPLATE);
    exit;
}

include(HEADER_TEMPLATE);
?>

<div class="container py-4">
    <h2 class="mb-4">Editar Notícia</h2>

    <?php if (!empty($_SESSION['msg'])): ?>
        <div class="alert alert-info"><?= htmlspecialchars($_SESSION['msg']); ?></div>
        <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>

    <form action="edit.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" required
                   value="<?= htmlspecialchars($noticia['titulo']); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Resumo</label>
            <textarea class="form-control" name="resumo" required><?= htmlspecialchars($noticia['resumo']); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Conteúdo</label>
            <textarea class="form-control" name="conteudo" required><?= htmlspecialchars($noticia['conteudo']); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem Atual</label><br>
            <img src="<?= BASE_URL ?>/public/uploads/noticias/<?= htmlspecialchars($noticia['imagem_principal']); ?>"
                 width="180" class="rounded">
        </div>

        <div class="mb-3">
            <label class="form-label">Nova Imagem (opcional)</label>
            <input type="file" name="imagem_principal" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
