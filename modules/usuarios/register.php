<?php
require_once(__DIR__ . '/../../init.php');
require_once(__DIR__ . '/functions.php');

/**
 * Função para checar se o e-mail já existe
 */

// Processa o registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nome_completo' => trim($_POST['nome_completo']),
        'email'        => trim($_POST['email']),
        'senha'        => trim($_POST['senha']),
        'nivel_acesso' => $_POST['nivel_acesso']
    ];

    if (email_exists($data['email'])) {
        $message = ['type' => 'warning', 'text' => 'Este e-mail já está registrado!'];
    } elseif (add_user($data)) {
        $message = ['type' => 'success', 'text' => 'Usuário registrado com sucesso!'];
    } else {
        $message = ['type' => 'danger', 'text' => 'Erro ao registrar usuário.'];
    }
}
?>

<!-- Bootstrap (link padrão do projeto) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= BASE_URL ?>/public/css/usuarios.css" rel="stylesheet">

<div class="container usuarios-container py-5">
  <div class="usuarios-card shadow-lg p-4 rounded-4 mx-auto" style="max-width: 500px;">
    <h2 class="text-center mb-4 text-primary fw-bold">Registrar-se</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $message['type'] ?> text-center mb-3">
            <?= htmlspecialchars($message['text']) ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="usuarios-form">
      <div class="mb-3">
        <label class="form-label fw-semibold">Nome completo</label>
        <input type="text" name="nome_completo" class="form-control border-2" placeholder="Digite seu nome" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control border-2" placeholder="exemplo@email.com" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Senha</label>
        <input type="password" name="senha" class="form-control border-2" placeholder="Digite uma senha segura" required>
      </div>

      <div class="mb-4">
        <label class="form-label fw-semibold">Tipo de conta</label>
        <select name="nivel_acesso" class="form-select border-2" required>
          <option value="">Selecione...</option>
          <option value="usuario">Usuário</option>
          <option value="escritor">Escritor</option>
        </select>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-warning text-dark fw-semibold py-2 rounded-3">
          Criar Conta
        </button>
      </div>

      <div class="text-center mt-3">
        <a href="<?= BASE_URL ?>/index.php" class="text-decoration-none text-primary fw-semibold">Voltar para o início</a> |
        <a href="<?= BASE_URL ?>/modules/usuarios/forgot_password.php" class="text-decoration-none text-primary fw-semibold">Esqueceu a senha?</a>
      </div>
    </form>
  </div>
</div>
