<?php 
/**
 * GLOBALFUNCTIONS.PHP
 * ----------------------------
 * Funções auxiliares reutilizáveis no sistema.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Exibe mensagens na tela (alertas Bootstrap)
 */
function showMessage($message, $type = 'info') {
    echo "<div class='alert alert-{$type}' role='alert'>{$message}</div>";
}

/**
 * Formata data (MySQL → DD/MM/AAAA)
 */
function formatDate($date) {
    if (!$date) return '';
    return date('d/m/Y H:i', strtotime($date));
}

/**
 * Redireciona para outra página
 */
function redirect($url) {
    header("Location: {$url}");
    exit;
}

/**
 * Garante que o usuário esteja logado
 */
function ensureLogged() {
    if (!isset($_SESSION['user'])) {
        redirect(BASE_URL . '/login.php');
    }
}
?>
