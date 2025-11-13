<?php
require_once 'init.php';
?>

<?php include(HEADER_TEMPLATE); ?>

<!-- Banner Rotativo -->
<div id="carouselBanner" class="carousel slide mt-4" data-bs-ride="carousel">
  <div class="carousel-inner custom-carousel-height">
    <!-- Slide 1 -->
    <div class="carousel-item active">
      <img src="<?= BASE_URL ?>/img/espaco.jpg" class="d-block w-100" alt="Banner 1">
      <div class="carousel-caption d-none d-md-block">
        <h5>Campeonato de E-Sports no Sesc!</h5>
        <p>Prepare-se para grandes torneios e prêmios incríveis!</p>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <img src="<?= BASE_URL ?>/img/saude.jpg" class="d-block w-100" alt="Banner 2">
      <div class="carousel-caption d-none d-md-block">
        <h5>Novos Jogos na Biblioteca Digital</h5>
        <p>Mais de 100 títulos gratuitos para os alunos!</p>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <img src="<?= BASE_URL ?>/img/espaco.jpg" class="d-block w-100" alt="Banner 3">
      <div class="carousel-caption d-none d-md-block">
        <h5>Sesc Game Jam 2025</h5>
        <p>Crie seu próprio jogo em 48 horas no evento Sesc Game Jam!</p>
      </div>
    </div>
  </div>

  <!-- Controles -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>

<!-- Notícias -->
<div class="container py-4">
  <h2 class="text-center mb-4">Últimas Notícias</h2>
  <div class="row g-4">
    <?php
    $noticias = [
        ['titulo' => 'Notícia 1', 'imagem' => BASE_URL.'/img/espaco.jpg', 'texto' => 'Descrição da notícia 1.'],
        ['titulo' => 'Notícia 2', 'imagem' => BASE_URL.'/img/saude.jpg', 'texto' => 'Descrição da notícia 2.'],
        ['titulo' => 'Notícia 3', 'imagem' => BASE_URL.'/img/espaco.jpg', 'texto' => 'Descrição da notícia 3.']
    ];
    foreach ($noticias as $n):
    ?>
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="<?= $n['imagem'] ?>" class="card-img-top" alt="<?= htmlspecialchars($n['titulo']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $n['titulo'] ?></h5>
            <p class="card-text"><?= $n['texto'] ?></p>
            <a href="#" class="btn btn-primary w-100">Saiba Mais</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
  /* Altura personalizada do carousel */
  .custom-carousel-height .carousel-item img {
    height: 400px; /* você pode ajustar entre 350-450px */
    object-fit: cover; /* mantém proporção e corta o excesso */
  }

  /* Legendas mais visíveis */
  .carousel-caption {
    background-color: rgba(0, 0, 0, 0.4);
    padding: 1rem;
    border-radius: 0.5rem;
  }
</style>
