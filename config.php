<?php
/**
 * CONFIG — Arquivo de Configuração Global
 * ---------------------------------------
 * Define constantes e configurações principais do projeto Sesc Esports.
 * Todos os caminhos e URLs são padronizados para evitar erros de linkagem.
 */

// ==========================
// 🔧 CAMINHOS DO SERVIDOR
// ==========================
define('ROOT_PATH', str_replace('\\', '/', __DIR__)); // Caminho absoluto do projeto
define('INC_PATH', ROOT_PATH . '/inc');
define('COMPONENTS_PATH', ROOT_PATH . '/components');
define('MODULES_PATH', ROOT_PATH . '/modules');
define('PUBLIC_PATH', ROOT_PATH . '/public');

// ==========================
// 🌐 CONFIGURAÇÃO DE URL BASE
// ==========================
// ➤ Se o projeto está em "htdocs/sesc_esports/", deixe assim:
define('BASE_URL', '/sesc_esports');

// ➤ Se estiver direto em "htdocs/", troque para:
// define('BASE_URL', '/');

// ==========================
// 🧩 TEMPLATES GLOBAIS
// ==========================
define('HEADER_TEMPLATE', INC_PATH . '/header.php');
define('FOOTER_TEMPLATE', INC_PATH . '/footer.php');

// ==========================
// 💾 BANCO DE DADOS (MySQL)
// ==========================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pi_noticias_sesc');

// ==========================
// ⚙️ CONFIGURAÇÕES OPCIONAIS
// ==========================

// Fuso horário padrão
date_default_timezone_set('America/Sao_Paulo');

// Relatórios de erro (desabilitar em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);
