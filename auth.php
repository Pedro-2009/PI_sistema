<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
  <div class="container">
    <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
    <p>Você está logado com sucesso.</p>
    <a href="logout.php" class="btn btn-danger mt-3">Sair</a>
  </div>
</body>
</html>
