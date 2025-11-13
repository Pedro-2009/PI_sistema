<?php
require_once('../../config.php');
require_once(INC_PATH . '/database.php');
require_once(__DIR__ . '/functions.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);
$noticia = find_news_by_id($id);
if (!$noticia) {
    header('Location: index.php');
    exit;
}
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container mt-5 pt-5">
    <h1 class="mb-3"><?= htmlspecialchars($noticia['titulo']); ?></h1>
    <p class="text-muted">
        Categoria: <?= htmlspecialchars($noticia['categoria_nome'] ?? 'Sem categoria'); ?> |
        Criado em: <?= date('d/m/Y H:i', strtotime($noticia['criado_em'])); ?>
    </p>
    <hr>
    <div class="mb-4">
        <?= nl2br(htmlspecialchars($noticia['conteudo'])); ?>
    </div>

    <a href="index.php" class="btn btn-primary">Voltar</a>
</div>

<?php include(FOOTER_TEMPLATE); ?>
