<?php
if (!defined('BASE_URL')) {
  require_once(__DIR__ . '/../config.php');
}
$B = BASE_URL;
?>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto text-light py-4" style="background-color: var(--sesc-blue);">
      <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="mb-3 mb-md-0 text-center text-md-start">
          <h5 class="fw-bold mb-1">Sesc Esports</h5>
          <small>&copy; <?php echo date('Y'); ?> — Todos os direitos reservados.</small>
        </div>

        <div class="text-center text-md-end">
          <a href="<?= $B ?>/modules/sobre/index.php" class="text-light text-decoration-none me-3">Sobre</a>
          <a href="<?= $B ?>/modules/contato/index.php" class="text-light text-decoration-none me-3">Contato</a>

          <!-- Ícones sociais -->
          <a href="https://www.instagram.com" target="_blank" class="text-light me-2">
            <i class="bi bi-instagram fs-5"></i>
          </a>
          <a href="https://www.facebook.com" target="_blank" class="text-light me-2">
            <i class="bi bi-facebook fs-5"></i>
          </a>
          <a href="https://www.youtube.com" target="_blank" class="text-light">
            <i class="bi bi-youtube fs-5"></i>
          </a>
        </div>
      </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts Globais -->
    <script src="<?= $B ?>/public/js/main.js"></script>

    <style>
      :root {
        --sesc-blue: #0056A3;
        --sesc-yellow: #FFD700;
      }

      .footer {
        position: relative;
        bottom: 0;
        width: 100%;
      }

      /* Garante que o footer fique fixo ao fim da tela em páginas curtas */
      html, body {
        height: 100%;
      }

      body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
      }

      main {
        flex: 1;
      }

      .footer a:hover {
        color: var(--sesc-yellow) !important;
      }
    </style>
  </body>
</html>
