<?php
// Caminho absoluto da raiz
define('BASE_PATH', __DIR__);

// Caminho da pasta "inc"
define('INC_PATH', BASE_PATH . '/inc');

// Inclui arquivos principais
require_once BASE_PATH . '/config.php';
require_once INC_PATH . '/database.php';
require_once INC_PATH . '/globalFunctions.php';

// Define templates padrão
define('HEADER_TEMPLATE', INC_PATH . '/header.php');
define('FOOTER_TEMPLATE', INC_PATH . '/footer.php');
?>
