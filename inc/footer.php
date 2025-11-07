<?php
if (!defined('BASE_URL')) {
  // fallback caso footer seja usado isolado
  $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
  $base = ($scriptDir === '/' || $scriptDir === '\\') ? '' : $scriptDir;
  define('BASE_URL', $base);
}
$B = BASE_URL;
?>
  </main>

  <!-- Footer fixo -->
  <footer class="sesc-footer text-light py-4 mt-auto">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
      <div class="mb-3 mb-md-0 text-center text-md-start">
        <h5 class="fw-bold mb-1">Sesc Esports</h5>
        <small>&copy; <?php echo date('Y'); ?> Todos os direitos reservados.</small>
      </div>

      <div class="text-center text-md-end">
        <a href="<?php echo $B; ?>/modules/sobre/index.php" class="footer-link me-3">Sobre</a>
        <a href="<?php echo $B; ?>/modules/contato/index.php" class="footer-link me-3">Contato</a>
        <a href="https://www.instagram.com" target="_blank" class="footer-icon me-2">
          <i class="bi bi-instagram fs-5"></i>
        </a>
        <a href="https://www.facebook.com" target="_blank" class="footer-icon me-2">
          <i class="bi bi-facebook fs-5"></i>
        </a>
        <a href="https://www.youtube.com" target="_blank" class="footer-icon">
          <i class="bi bi-youtube fs-5"></i>
        </a>
      </div>
    </div>
  </footer>

  <!-- Bootstrap Bundle JS (necessário para dropdowns e colapsos) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- CSS Inline para manter o padrão -->
  <style>
    :root {
      --sesc-blue: #0056A3;
      --sesc-yellow: #FFD700;
    }

    html, body {
      height: 100%;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
      background-color: #f8f9fa;
    }

    main {
      flex: 1;
    }

    /* FOOTER */
    .sesc-footer {
      background-color: var(--sesc-blue);
      color: white;
      text-align: center;
      margin-top: auto;
      box-shadow: 0 -2px 6px rgba(0,0,0,0.15);
    }

    .footer-link {
      color: #fff;
      text-decoration: none;
      transition: color 0.2s ease, transform 0.2s ease;
    }

    .footer-link:hover {
      color: var(--sesc-yellow);
      transform: scale(1.05);
    }

    .footer-icon {
      color: #fff;
      transition: color 0.2s ease, transform 0.2s ease;
    }

    .footer-icon:hover {
      color: var(--sesc-yellow);
      transform: scale(1.1);
    }
  </style>
</body>
</html>
