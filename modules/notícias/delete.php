<?php
require_once('../../config.php');
require_once(INC_PATH . '/database.php');
require_once(__DIR__ . '/functions.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);
$success = delete_news($id);

if ($success) {
    $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Notícia excluída com sucesso!'];
} else {
    $_SESSION['messages'][] = ['type' => 'danger', 'text' => 'Erro ao excluir a notícia.'];
}

header('Location: index.php');
exit;
?>
