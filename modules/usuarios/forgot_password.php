<?php
require_once(__DIR__ . '/../../init.php');
require_once(__DIR__ . '/functions.php');
include(HEADER_TEMPLATE);

// Processa o pedido de redefinição (a lógica completa será implementada depois)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);

  // Aqui no futuro: gerar token, enviar link de redefinição, etc.
  echo "<div class='alert alert-info text-center m-3'>
          Se o e-mail <b>{$email}</b> estiver cadastrado, você receberá um link para redefinir sua senha.
        </div>";
}
?>

<!-- Bootstrap (link padrão do projeto) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/public/css/usuarios.css" rel="stylesheet">

<div class="container usuarios-container py-5">
  <div class="usuarios-card shadow-lg p-4 rounded-4 mx-auto" style="max-width: 500px;">
    <h2 class="text-center mb-4 text-primary fw-bold">Recuperar Senha</h2>

    <form method="POST" class="usuarios-form">
      <div class="mb-3">
        <label class="form-label fw-semibold">E-mail cadastrado</label>
        <input type="email" name="email" class="form-control border-2" placeholder="Digite seu e-mail" required>
      </div>

      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-warning text-dark fw-semibold py-2 rounded-3">
          Enviar link de redefinição
        </button>
      </div>

      <div class="text-center">
        <a href="register.php" class="text-decoration-none text-primary fw-semibold me-2">Criar conta</a> |
        <a href="/index.php" class="text-decoration-none text-primary fw-semibold ms-2">Voltar</a>
      </div>
    </form>
  </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
