<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/database.php');
require_once(MODULES_PATH . '/notícias/functions.php');
require_once(MODULES_PATH . '/categorias/functions.php');
require_once(INC_PATH . '/header.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<div class='container py-5 text-center'><div class='alert alert-danger'>ID da notícia não fornecido.</div></div>";
    include(FOOTER_TEMPLATE);
    exit;
}

$noticia = find_news_by_id($id);

if (!$noticia) {
    echo "<div class='container py-5 text-center'><div class='alert alert-warning'>Notícia não encontrada.</div></div>";
    include(FOOTER_TEMPLATE);
    exit;
}

// Atualiza contador de visualizações
increment_news_views($id);
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-9">

      <!-- Título -->
      <h1 class="fw-bold text-primary mb-3"><?= htmlspecialchars($noticia['titulo']); ?></h1>

      <!-- Info da notícia -->
      <div class="text-muted mb-4">
        <i class="bi bi-calendar-event"></i> <?= date('d/m/Y', strtotime($noticia['data_publicacao'])); ?>
        <?php if (!empty($noticia['categoria_id'])): ?>
          • <i class="bi bi-folder"></i>
          <?= htmlspecialchars(get_category_name($noticia['categoria_id'])); ?>
        <?php endif; ?>
        <?php if (!empty($noticia['autor_id'])): ?>
          • <i class="bi bi-person"></i> Autor: <?= htmlspecialchars(get_author_name($noticia['autor_id'])); ?>
        <?php endif; ?>
        • <i class="bi bi-eye"></i> <?= (int)$noticia['visualizacoes']; ?> visualizações
      </div>

      <!-- Imagem principal -->
      <?php if (!empty($noticia['imagem_principal'])): ?>
        <img src="<?= BASE_URL . '/' . htmlspecialchars($noticia['imagem_principal']); ?>"
             alt="Imagem da notícia"
             class="img-fluid rounded shadow-sm mb-4"
             style="max-height: 450px; object-fit: cover; width: 100%;">
      <?php endif; ?>

      <!-- Resumo -->
      <?php if (!empty($noticia['resumo'])): ?>
        <p class="lead text-secondary"><?= nl2br(htmlspecialchars($noticia['resumo'])); ?></p>
      <?php endif; ?>

      <!-- Conteúdo -->
      <div class="fs-5 lh-lg text-dark">
        <?= nl2br(htmlspecialchars($noticia['conteudo'])); ?>
      </div>

      <!-- Voltar -->
      <div class="mt-5">
        <a href="<?= BASE_URL ?>/index.php" class="btn btn-outline-primary">
          <i class="bi bi-arrow-left"></i> Voltar para notícias
        </a>
      </div>
    </div>
  </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
