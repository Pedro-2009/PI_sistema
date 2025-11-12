<?php
require_once(__DIR__ . '/config.php');
include(HEADER_TEMPLATE);
?>

<main class="flex-grow-1">

  <!-- Banner Principal -->
  <section class="banner position-relative overflow-hidden mb-5">
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://source.unsplash.com/1600x500/?sports,stadium" class="d-block w-100" alt="Esportes">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
            <h2 class="fw-bold text-warning">Grandes Jogos da Semana</h2>
            <p>Confira os destaques esportivos mais recentes do Sesc Esports.</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="https://source.unsplash.com/1600x500/?soccer,match" class="d-block w-100" alt="Futebol">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
            <h2 class="fw-bold text-warning">Cobertura Especial: Torneio Escolar</h2>
            <p>Os melhores momentos das competições entre as escolas do Sesc.</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="https://source.unsplash.com/1600x500/?basketball,arena" class="d-block w-100" alt="Basquete">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
            <h2 class="fw-bold text-warning">Basquete em Alta</h2>
            <p>Veja como os alunos se destacaram na última rodada de jogos.</p>
          </div>
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </button>
    </div>
  </section>

  <!-- Notícias em Destaque -->
  <section class="container mb-5">
    <h3 class="fw-bold border-bottom pb-2 mb-4 text-sesc-blue">Destaques</h3>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="https://source.unsplash.com/500x300/?soccer" class="card-img-top" alt="Notícia 1">
          <div class="card-body">
            <h5 class="card-title fw-semibold">Final do Torneio de Futebol</h5>
            <p class="card-text">A final entre as turmas do ensino médio foi marcada por muita emoção e gols incríveis.</p>
            <a href="#" class="btn btn-outline-primary btn-sm">Ler mais</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="https://source.unsplash.com/500x300/?volleyball" class="card-img-top" alt="Notícia 2">
          <div class="card-body">
            <h5 class="card-title fw-semibold">Time de Vôlei Feminino Invicto</h5>
            <p class="card-text">As atletas do Sesc garantiram mais uma vitória e seguem firmes rumo ao título.</p>
            <a href="#" class="btn btn-outline-primary btn-sm">Ler mais</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="https://source.unsplash.com/500x300/?basketball" class="card-img-top" alt="Notícia 3">
          <div class="card-body">
            <h5 class="card-title fw-semibold">Basquete: Novos Talentos</h5>
            <p class="card-text">Conheça os novos destaques da equipe sub-17 de basquete que vem surpreendendo.</p>
            <a href="#" class="btn btn-outline-primary btn-sm">Ler mais</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Últimas Notícias -->
  <section class="container mb-5">
    <h3 class="fw-bold border-bottom pb-2 mb-4 text-sesc-blue">Últimas Notícias</h3>
    <div class="row g-4">
      <?php for ($i = 1; $i <= 6; $i++): ?>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm h-100">
            <img src="https://source.unsplash.com/500x300/?sports,<?= $i ?>" class="card-img-top" alt="Notícia <?= $i ?>">
            <div class="card-body">
              <h6 class="fw-bold">Notícia <?= $i ?> — Título de Exemplo</h6>
              <p class="small text-muted mb-2">Publicado em <?= date('d/m/Y') ?></p>
              <p class="card-text">Resumo breve da notícia <?= $i ?> sobre o mundo esportivo Sesc Esports.</p>
              <a href="#" class="btn btn-sm btn-outline-secondary">Continuar lendo</a>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    </div>
  </section>

</main>

<?php include(FOOTER_TEMPLATE); ?>
