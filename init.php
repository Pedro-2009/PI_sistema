<?php
/**
 * INIT — Inicializador do sistema Sesc Esports
 * --------------------------------------------
 * Este arquivo é responsável por carregar todas as dependências principais
 * e garantir que as sessões, configurações e conexões estejam prontas.
 *
 * ➤ Deve ser incluído no início de TODAS as páginas do sistema.
 */

 // =========================================
 // 🔧 Carregamento dos arquivos principais
 // =========================================
require_once(__DIR__ . '/config.php');
require_once(INC_PATH . '/database.php');
require_once(INC_PATH . '/globalFunctions.php');

// =========================================
// 🧠 Sessão
// =========================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// =========================================
// 💾 Conexão com o banco de dados
// =========================================
$conn = open_database();

if (!$conn) {
    echo "<div style='color: red; font-weight: bold; text-align:center; margin-top:20px;'>
            Erro ao conectar ao banco de dados.
          </div>";
    exit;
}

// =========================================
// 📦 Constantes de Template
// =========================================
if (!defined('HEADER_TEMPLATE')) {
    define('HEADER_TEMPLATE', INC_PATH . '/header.php');
}
if (!defined('FOOTER_TEMPLATE')) {
    define('FOOTER_TEMPLATE', INC_PATH . '/footer.php');
}

// =========================================
// ✅ Sistema inicializado com sucesso
// =========================================
// echo "<!-- Sistema inicializado com sucesso (Sesc Esports) -->";
