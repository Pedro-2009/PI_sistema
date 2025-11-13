<?php
require_once 'init.php';
?>

<?php include(HEADER_TEMPLATE); ?>

<!-- Banner Rotativo Bootstrap -->
<div id="carouselBanner" class="carousel slide mt-4" data-bs-ride="carousel">
  <div class="carousel-inner" style="height: 350px;">
    <!-- Slide 1 -->
    <div class="carousel-item active">
      <img src="<?= BASE_URL ?>/img/esporte.jpg" class="d-block w-100 rounded" alt="Banner 1" style="height:100%; object-fit:cover;">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
        <h5>Campeonato de E-Sports no Sesc!</h5>
        <p>Prepare-se para grandes torneios e prêmios incríveis!</p>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <img src="<?= BASE_URL ?>/img/saude.jpg" class="d-block w-100 rounded" alt="Banner 2" style="height:100%; object-fit:cover;">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
        <h5>Novos Jogos na Biblioteca Digital</h5>
        <p>Mais de 100 títulos gratuitos para os alunos!</p>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <img src="<?= BASE_URL ?>/img/espaco.jpg" class="d-block w-100 rounded" alt="Banner 3" style="height:100%; object-fit:cover;">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
        <h5>Sesc Game Jam 2025</h5>
        <p>Crie seu próprio jogo em 48 horas no evento Sesc Game Jam!</p>
      </div>
    </div>
  </div>

  <!-- Controles -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>
<br><br>
<div class="container py-5">
  <h2 class="text-center mb-5">Últimas Notícias</h2>
  <div class="row row-cols-5 row-cols-md-3 g-5"> <!-- g-4 adiciona espaçamento entre colunas e linhas -->
    <?php
    $noticias = [
        ['titulo' => 'Vôlei em Ação', 'imagem' => BASE_URL.'/img/voleibol.jpg', 'texto' => 'As jogadoras demonstram garra e técnica em uma disputa acirrada na quadra.'],
        ['titulo' => 'Muita Emoção na Linha de Chegada', 'imagem' => BASE_URL.'/img/corrida.jpg', 'texto' => 'Em um dia ensolarado, corredores de todas as idades celebram o esporte na corrida de rua.'],
        ['titulo' => 'Esporte e Salto: Aventura no Ginásio', 'imagem' => BASE_URL.'/img/ginastica.jpg', 'texto' => 'Em um dia de muita energia, a ginástica acrobática e os trampolins foram as grandes atrações para o público.'],
        ['titulo' => 'Aulas de Natação no Sesc', 'imagem' => BASE_URL.'/img/nataçao.jpg', 'texto' => 'Alunos participam de atividades de natação, aprendendo técnicas e se divertindo na piscina.'],
        ['titulo' => 'Treino e Diversidade na Academia', 'imagem' => BASE_URL.'/img/academia.png', 'texto' => 'Não importa a idade, a academia Sesc recebe todos que querem se manter ativos e com saúde em 2024.'],
        ['titulo' => 'Treino Intenso na Quadra', 'imagem' => BASE_URL.'/img/futsalkid.jfif', 'texto' => 'Foco no drible! O treinamento das categorias de base do Sesc prepara os jovens atletas para o futuro do esporte.']
    ];
    foreach ($noticias as $n):
    ?>
      <div class="col d-flex">
        <div class="card shadow-sm flex-fill mb-4"> <!-- mb-4 adiciona margem inferior extra -->
          <img src="<?= $n['imagem'] ?>" class="card-img-top img-fluid rounded-top" style="height: 200px; object-fit: cover;" alt="<?= htmlspecialchars($n['titulo']) ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-3"><?= $n['titulo'] ?></h5>
            <p class="card-text flex-grow-1"><?= $n['texto'] ?></p>
            <a href="#" class="btn btn-primary w-100 mt-2">Saiba Mais</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php require_once(FOOTER_TEMPLATE); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
