<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/database.php');
require_once(INC_PATH . '/globalFunctions.php');
require_once(__DIR__ . '/functions.php');

if (session_status() === PHP_SESSION_NONE) session_start();

$conn = open_database();
if (!$conn) {
    echo "<div class='alert alert-danger text-center'>Erro ao conectar ao banco.</div>";
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    $_SESSION['msg'] = "ID inválido.";
    header("Location: index.php");
    exit;
}

$noticia = find_news_by_id($id);

if (!$noticia) {
    $_SESSION['msg'] = "Notícia não encontrada.";
    header("Location: index.php");
    exit;
}

// 🔥 Excluir imagem física, se existir
$imgPath = PUBLIC_PATH . "/uploads/noticias/" . $noticia['imagem_principal'];
if (file_exists($imgPath) && is_file($imgPath)) {
    unlink($imgPath);
}

// 🔥 Excluir do banco
$sql = "DELETE FROM noticias WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['msg'] = "Notícia deletada com sucesso!";
} else {
    $_SESSION['msg'] = "Erro ao deletar notícia.";
}

header("Location: index.php");
exit;
