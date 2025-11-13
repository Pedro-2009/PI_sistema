<?php
require_once 'init.php';

// Se já logado, redireciona
if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - <?php echo SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <div class="card">
        <h3>Acessar Sistema</h3>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="auth.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="text" id="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>

        <div class="login-footer">
            <a href="/modules/usuarios/forgot_password.php">Esqueceu a senha?</a> |
            <a href="/modules/usuarios/register.php">Registrar-se</a>
        </div>
    </div>
</body>
</html>
