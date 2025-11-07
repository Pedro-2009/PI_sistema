<?php
session_start();
$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $found = false;
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $_SESSION['user'] = $email;
            header('Location: auth.php');
            exit;
        }
    }

    $error = 'Email ou senha incorretos!';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- ✅ Bootstrap 5.3.8 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../../css/login.css">
</head>
<body>
  <div class="login-box">
    <h3 class="text-center mb-4">Acesso ao Sistema</h3>

    <?php if ($error): ?>
      <div class="alert alert-danger text-center py-2"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Digite seu email" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" name="password" class="form-control" placeholder="Digite sua senha" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>

      <div class="d-flex justify-content-between">
        <a href="forgot_password.php" class="btn btn-link text-secondary">Esqueci minha senha</a>
        <a href="register.php" class="btn btn-link text-primary">Criar conta</a>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
