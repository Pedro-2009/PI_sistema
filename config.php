<?php
/**
 * CONFIGURAÇÕES GERAIS DO PROJETO
 * --------------------------------
 * Centraliza as definições de diretórios, banco de dados e constantes globais.
 */

// Define o caminho base absoluto do projeto
define('BASE_PATH', __DIR__);

// Caminhos para diretórios principais
define('INC_PATH', BASE_PATH . '/inc');
define('COMPONENTS_PATH', BASE_PATH . '/components');
define('MODULES_PATH', BASE_PATH . '/modules');
define('PUBLIC_PATH', BASE_PATH . '/public');

// Templates principais (header e footer)
define('HEADER_TEMPLATE', INC_PATH . '/header.php');
define('FOOTER_TEMPLATE', INC_PATH . '/footer.php');

// Caminho base da URL (ajuste conforme seu ambiente local)
define('BASE_URL', '/sesc_esports'); // ex: http://localhost/sesc_esports

// --- Banco de Dados ---
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pi_noticias_sesc');

// --- Configurações de sessão ---
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
