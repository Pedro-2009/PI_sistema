<?php
if (!defined('BASE_URL')) {
  require_once(__DIR__ . '/../config.php');
}
$B = BASE_URL;
?>
    </main>

    <!-- 🌟 FOOTER GLOBAL -->
    <footer class="footer">
      <div class="footer-container">
        <div class="footer-info">
          <h5>Sesc Esports</h5>
          <small>&copy; <?= date('Y'); ?> — Todos os direitos reservados.</small>
        </div>

        <div class="footer-links">
          <a href="<?= $B ?>/modules/sobre/index.php">Sobre</a>
          <a href="<?= $B ?>/modules/contato/index.php">Contato</a>

          <!-- 🔗 Ícones Sociais -->
          <a href="https://www.instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
          <a href="https://www.facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
          <a href="https://www.youtube.com" target="_blank"><i class="bi bi-youtube"></i></a>
        </div>
      </div>
    </footer>

    <!-- Script global -->
    <script src="<?= $B ?>/public/js/main.js"></script>
  </body>
</html>
