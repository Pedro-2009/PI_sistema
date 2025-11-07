<?php
require_once(__DIR__ . '/../../init.php');
require_once(__DIR__ . '/functions.php');

$id = $_GET['id'] ?? null;
if ($id && delete_user($id)) {
  header("Location: index.php");
  exit;
} else {
  echo "<div class='alert alert-danger text-center mt-4'>Erro ao excluir usuário.</div>";
}
?>
