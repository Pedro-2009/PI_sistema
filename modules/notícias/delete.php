<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/globalFunctions.php');
require_once(INC_PATH . '/database.php');

if (session_status() === PHP_SESSION_NONE) session_start();
$conn = open_database();

if (!$conn) {
    showMessage("Erro ao conectar ao banco de dados.", "danger");
    header("Location: " . BASE_URL . "/modules/notícias/index.php");
    exit;
}

// Verifica ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    showMessage("ID inválido.", "warning");
    header("Location: " . BASE_URL . "/modules/notícias/index.php");
    exit;
}

// Busca notícia
$sql = "SELECT * FROM noticias WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    showMessage("Notícia não encontrada.", "warning");
    header("Location: " . BASE_URL . "/modules/notícias/index.php");
    exit;
}

$noticia = $result->fetch_assoc();

// Deletar imagem se existir
if (!empty($noticia['imagem'])) {
    $imagemPath = PUBLIC_PATH . "/uploads/noticias/" . $noticia['imagem'];
    if (file_exists($imagemPath)) {
        unlink($imagemPath);
    }
}

// Deleta do banco
$sqlDelete = "DELETE FROM noticias WHERE id = ?";
$stmtDelete = $conn->prepare($sqlDelete);
$stmtDelete->bind_param("i", $id);

if ($stmtDelete->execute()) {
    showMessage("Notícia deletada com sucesso!", "success");
} else {
    showMessage("Erro ao deletar a notícia.", "danger");
}

header("Location: " . BASE_URL . "/modules/notícias/index.php");
exit;
?>
