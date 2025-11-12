<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once(__DIR__ . '/../config.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sesc Esports</title>

  <!-- Bootstrap e Ícones -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS Global -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/bootstrap.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/headerStyles.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm" style="background-color: #0056A3;">
    <div class="container">
      <a class="navbar-brand fw-bold text-uppercase d-flex align-items-center" href="<?= BASE_URL ?>/index.php">
        <i class="bi bi-trophy-fill text-warning me-2 fs-4"></i> Sesc Esports
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php">Início</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNoticias" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Notícias
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= BASE_URL ?>/modules/noticias/index.php">Ver todas</a></li>
              <li><a class="dropdown-item" href="<?= BASE_URL ?>/modules/noticias/add.php">Adicionar nova</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/modules/categorias/index.php">Categorias</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/modules/usuarios/index.php">Usuários</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/login.php">Entrar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container mt-5 pt-4">
