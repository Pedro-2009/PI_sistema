<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// tenta carregar config se existir (se já tiver, manter)
if (file_exists(__DIR__ . '/../config.php')) {
    require_once __DIR__ . '/../config.php';
}

// calcula BASE_URL seguro (fallback dinâmico)
if (!defined('BASE_URL')) {
    // dirname($_SERVER['SCRIPT_NAME']) -> /nome_da_pasta (ou '/')
    $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    $base = ($scriptDir === '/' || $scriptDir === '\\') ? '' : $scriptDir;
    define('BASE_URL', $base);
}
$B = BASE_URL; // variável curta para usar no HTML
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sesc Esports</title>

  <!-- Bootstrap CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Optional: seu CSS custom (usar BASE_URL para apontar corretamente) -->
  <link href="<?php echo $B; ?>/public/css/headerStyles.css" rel="stylesheet">
  <link href="<?php echo $B; ?>/public/css/style.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm" style="background:#0056A3;">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="<?php echo $B ?: '/'; ?>/../index.php">
        <i class="bi bi-trophy-fill text-warning me-2 fs-4"></i>
        <span class="fw-bold text-uppercase">Sesc Esports</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navCollapse"
              aria-controls="navCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navCollapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="<?php echo $B ?: '/'; ?>/index.php">Início</a></li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="ddNoticias" role="button" data-bs-toggle="dropdown" aria-expanded="false">Notícias</a>
            <ul class="dropdown-menu" aria-labelledby="ddNoticias">
              <li><a class="dropdown-item" href="<?php echo $B; ?>/modules/noticias/index.php">Ver todas</a></li>
              <li><a class="dropdown-item" href="<?php echo $B; ?>/modules/noticias/add.php">Adicionar</a></li>
            </ul>
          </li>

          <li class="nav-item"><a class="nav-link" href="<?php echo $B; ?>/modules/categorias/index.php">Esportes</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $B; ?>/modules/sobre/index.php">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $B; ?>/login.php">Entrar</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- compensar fixed-top -->
  <div style="height:72px;"></div>

  <main class="container my-4">
