<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sesc Esports</title>

  <!-- Bootstrap 5 mais recente (CDN oficial) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Ícones do Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS personalizado -->
  <link href="/public/css/style.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand fw-bold text-uppercase" href="/index.php">
        <i class="bi bi-trophy me-2 text-warning"></i> Sesc Esports
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="/index.php">Início</a></li>
          <li class="nav-item"><a class="nav-link" href="/modules/noticias/index.php">Notícias</a></li>
          <li class="nav-item"><a class="nav-link" href="/modules/esportes/index.php">Esportes</a></li>
          <li class="nav-item"><a class="nav-link" href="/modules/sobre/index.php">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="/login.php">Entrar</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container my-4">
