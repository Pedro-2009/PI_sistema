<?php
require_once(__DIR__ . '/../../init.php');
require_once(__DIR__ . '/functions.php');

// Processa o registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'nome' => $_POST['nome'],
    'email' => $_POST['email'],
    'senha' => $_POST['senha'],
    'nivel_acesso' => $_POST['nivel_acesso']
  ];

  if (add_user($data)) {
    echo "<div class='alert alert-success text-center m-3'>Usuário registrado com sucesso!</div>";
  } else {
    echo "<div class='alert alert-danger text-center m-3'>Erro ao registrar usuário.</div>";
  }
}
?>

<!-- Bootstrap (link padrão do projeto) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/public/css/usuarios.css" rel="stylesheet">

<div class="container usuarios-container py-5">
  <div class="usuarios-card shadow-lg p-4 rounded-4 mx-auto" style="max-width: 500px;">
    <h2 class="text-center mb-4 text-primary fw-bold">Registrar-se</h2>
    
    <form method="POST" class="usuarios-form">
      <div class="mb-3">
        <label class="form-label fw-semibold">Nome completo</label>
        <input type="text" name="nome" class="form-control border-2" placeholder="Digite seu nome" required>
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
        <a href="../index.php" class="text-decoration-none text-primary fw-semibold">Voltar para o início</a>
      </div>
    </form>
  </div>
</div>


