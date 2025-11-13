<?php
require_once 'init.php';

// Se já logado, redireciona
if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

// Captura e limpa a mensagem de erro da sessão
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - <?= SITE_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/login.css">
</head>
<body>
    <div class="card shadow-lg p-4 mx-auto mt-5" style="max-width: 400px;">
        <h3 class="text-center mb-4">Acessar Sistema</h3>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/auth.php" method="POST">
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

        <div class="login-footer mt-3 text-center">
            <a href="<?= BASE_URL ?>/modules/usuarios/forgot_password.php" class="text-decoration-none">Esqueceu a senha?</a> |
            <a href="<?= BASE_URL ?>/modules/usuarios/register.php" class="text-decoration-none">Registrar-se</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
