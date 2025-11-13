<?php
require_once(__DIR__ . '/../config.php');
if (session_status() === PHP_SESSION_NONE) session_start();

// Exemplo de usuário logado (remover ou substituir pelo login real)
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        'id' => 1,
        'nome' => 'Pedro Henrique',
        'email' => 'pedro@example.com',
        'nivel_acesso' => 'Admin'
    ];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sesc Esports</title>

  <!-- Bootstrap e ícones -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS Global -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/headerStyles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/footerStyles.css">
</head>
<body>

<!-- 🏆 HEADER -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm custom-navbar">
  <div class="container">
    <a class="navbar-brand fw-bold text-uppercase d-flex align-items-center" href="<?= BASE_URL ?>/index.php">
      <i class="bi bi-trophy-fill text-warning me-2 fs-4 animate-trophy"></i>
      <span>Sesc Esports</span>
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
          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/modules/notícias/index.php">Ver todas</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/modules/notícias/add.php">Adicionar nova</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/modules/categorias/index.php">Categorias</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/modules/usuarios/index.php">Usuários</a>
        </li>

        <!-- Dropdown do perfil -->
        <li class="nav-item dropdown ms-lg-2">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-5 me-1 text-warning"></i>
            <span><?= htmlspecialchars($_SESSION['user']['nome']); ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li class="dropdown-item-text">
              <strong>Nome:</strong> <?= htmlspecialchars($_SESSION['user']['nome']); ?><br>
              <strong>Email:</strong> <?= htmlspecialchars($_SESSION['user']['email']); ?><br>
              <strong>Nível:</strong> <?= htmlspecialchars($_SESSION['user']['nivel_acesso']); ?>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item text-danger fw-semibold" href="<?= BASE_URL ?>/logout.php">
                <i class="bi bi-box-arrow-right me-2"></i> Sair
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container mt-5 pt-5">
