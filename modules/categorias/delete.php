<?php
require_once(__DIR__ . '/../../config.php');
require_once(MODULES_PATH . '/categorias/functions.php');

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

$success = delete_category($id);

if ($success) {
    $message = "Categoria deletada com sucesso!";
    $alertType = "success";
} else {
    $message = "Erro ao deletar categoria.";
    $alertType = "danger";
}

// Redireciona para index com mensagem
header("Location: index.php?message=" . urlencode($message) . "&alert=" . $alertType);
exit;
?>
