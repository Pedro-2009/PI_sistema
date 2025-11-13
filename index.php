<?php
require_once 'init.php';
require_once __DIR__ . '/modules/notícias/functions.php';

include(HEADER_TEMPLATE);

// Carrega todas as notícias cadastradas
$noticias = find_all_news();
?>

<!-- Banner Rotativo Bootstrap -->
<div id="carouselBanner" class="carousel slide mt-4" data-bs-ride="carousel">
  <div class="carousel-inner" style="height: 350px;">

    <div class="carousel-item active">
      <img src="<?= BASE_URL ?>/img/esporte.jpg" class="d-block w-100 rounded" alt="Banner 1"
           style="height:100%; object-fit:cover;">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
        <h5>Campeonato de E-Sports no Sesc!</h5>
        <p>Prepare-se para grandes torneios e prêmios incríveis!</p>
      </div>
    </div>

    <div class="carousel-item">
      <img src="<?= BASE_URL ?>/img/saude.jpg" class="d-block w-100 rounded" alt="Banner 2"
           style="height:100%; object-fit:cover;">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
        <h5>Novos Jogos na Biblioteca Digital</h5>
        <p>Mais de 100 títulos gratuitos para os alunos!</p>
      </div>
    </div>

    <div class="carousel-item">
      <img src="<?= BASE_URL ?>/img/espaco.jpg" class="d-block w-100 rounded" alt="Banner 3"
           style="height:100%; object-fit:cover;">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
        <h5>Sesc Game Jam 2025</h5>
        <p>Crie seu próprio jogo em 48 horas no evento Sesc Game Jam!</p>
      </div>
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>


<!-- Botão Adicionar Notícia -->
<div class="container py-5">
  <div class="row justify-content-start">
    <?php if (!empty($_SESSION['user']) && in_array($_SESSION['user']['nivel_acesso'], ['escritor', 'admin'])): ?>
      <div class="col-md-5 mb-4">
        <a href="<?= BASE_URL ?>/modules/notícias/add.php" class="text-decoration-none">
          <div class="card shadow-sm d-flex flex-column align-items-center justify-content-center p-4"
               style="height: 200px; transition: all 0.3s;">
            <i class="bi bi-plus-lg" style="font-size: 3rem; color: #0d6efd;"></i>
            <h5 class="mt-3 text-primary fw-semibold">Adicionar Nova Notícia</h5>
          </div>
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>


<!-- 📰 LISTAGEM DE NOTÍCIAS -->
<div class="container pb-5">
  <h2 class="mb-4 fw-bold">Últimas Notícias</h2>

  <div class="row g-4">

    <?php if ($noticias instanceof mysqli_result && $noticias->num_rows > 0): ?>
      <?php while ($n = $noticias->fetch_assoc()): ?>

        <div class="col-md-4">
          <div class="card shadow-sm h-100">

            <!-- Imagem da notícia -->
            <?php if (!empty($n['imagem_principal'])): ?>
              <img src="<?= BASE_URL ?>/public/uploads/noticias/<?= $n['imagem_principal'] ?>"
                   class="card-img-top"
                   style="height: 200px; object-fit: cover;">
            <?php else: ?>
              <img src="<?= BASE_URL ?>/img/default.jpg"
                   class="card-img-top"
                   style="height: 200px; object-fit: cover;">
            <?php endif; ?>

            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= htmlspecialchars($n['titulo']) ?></h5>
              <p class="card-text text-muted"><?= htmlspecialchars($n['resumo']) ?></p>

              <a href="<?= BASE_URL ?>/modules/notícias/view.php?id=<?= $n['id'] ?>"
                 class="btn btn-primary mt-auto">
                Ler mais
              </a>
            </div>

          </div>
        </div>

      <?php endwhile; ?>

    <?php else: ?>

      <p class="text-muted">Nenhuma notícia cadastrada ainda.</p>

    <?php endif; ?>

  </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
