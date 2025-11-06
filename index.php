<?php require_once 'init.php'; ?>
<?php include(HEADER_TEMPLATE); ?>

<div class="text-center py-5">
  <h1 class="display-5 fw-bold text-primary">Bem-vindo ao <span class="text-warning">Sesc Esports</span>!</h1>
  <p class="lead mb-4">Fique por dentro das últimas notícias e eventos esportivos do nosso colégio.</p>
  <a href="/modules/noticias/index.php" class="btn btn-primary btn-lg shadow-sm">
    <i class="bi bi-newspaper me-2"></i> Ver notícias
  </a>
</div>

<hr class="my-5">

<section class="container">
  <h2 class="mb-4 text-center text-primary">Últimas Notícias</h2>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card h-100">
        <img src="https://picsum.photos/600/300?random=1" class="card-img-top" alt="Notícia 1">
        <div class="card-body">
          <h5 class="card-title text-primary">Campeonato de Futsal</h5>
          <p class="card-text">A equipe do Sesc garantiu a vitória na semifinal com um placar de 3x1.</p>
        </div>
        <div class="card-footer text-end">
          <small class="text-muted">Publicado em 06/11/2025</small>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100">
        <img src="https://picsum.photos/600/300?random=2" class="card-img-top" alt="Notícia 2">
        <div class="card-body">
          <h5 class="card-title text-primary">Torneio de Xadrez</h5>
          <p class="card-text">Os alunos mostraram grande estratégia nas partidas da fase final.</p>
        </div>
        <div class="card-footer text-end">
          <small class="text-muted">Publicado em 05/11/2025</small>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100">
        <img src="https://picsum.photos/600/300?random=3" class="card-img-top" alt="Notícia 3">
        <div class="card-body">
          <h5 class="card-title text-primary">Treino Aberto de Vôlei</h5>
          <p class="card-text">A equipe de vôlei convidou os alunos para participarem de um treino especial.</p>
        </div>
        <div class="card-footer text-end">
          <small class="text-muted">Publicado em 04/11/2025</small>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include(FOOTER_TEMPLATE); ?>
