<?php
require_once(__DIR__ . '/../../init.php');
require_once(__DIR__ . '/functions.php');
include(HEADER_TEMPLATE);

// Verifica se o ID foi informado
if (!isset($_GET['id'])) {
  echo "<div class='alert alert-danger text-center m-3'>ID de usuário não informado.</div>";
  include(FOOTER_TEMPLATE);
  exit;
}

$id = intval($_GET['id']);
$user = find_user_by_id($id);

// Caso não exista
if (!$user) {
  echo "<div class='alert alert-warning text-center m-3'>Usuário não encontrado.</div>";
  include(FOOTER_TEMPLATE);
  exit;
}

// Processa atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'nome' => $_POST['nome'],
    'email' => $_POST['email'],
    'nivel_acesso' => $_POST['nivel_acesso']
  ];

  if (update_user($id, $data)) {
    echo "<div class='alert alert-success text-center m-3'>Usuário atualizado com sucesso!</div>";
    // Atualiza dados em tempo real
    $user = find_user_by_id($id);
  } else {
    echo "<div class='alert alert-danger text-center m-3'>Erro ao atualizar usuário.</div>";
  }
}
?>

<!-- Bootstrap e CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/public/css/usuarios.css" rel="stylesheet">

<div class="container usuarios-container py-5">
  <div class="usuarios-card shadow-lg p-4 rounded-4 mx-auto" style="max-width: 600px;">
    <h2 class="text-center mb-4 text-primary fw-bold">Editar Usuário</h2>

    <form method="POST" class="usuarios-form">
      <div class="mb-3">
        <label class="form-label fw-semibold">Nome completo</label>
        <input type="text" name="nome" class="form-control border-2" 
               value="<?= htmlspecialchars($user['nome']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control border-2" 
               value="<?= htmlspecialchars($user['email']) ?>" required>
      </div>

      <div class="mb-4">
        <label class="form-label fw-semibold">Nível de acesso</label>
        <select name="nivel_acesso" class="form-select border-2" required>
          <option value="usuario" <?= $user['nivel_acesso'] === 'usuario' ? 'selected' : '' ?>>Usuário</option>
          <option value="escritor" <?= $user['nivel_acesso'] === 'escritor' ? 'selected' : '' ?>>Escritor</option>
          <option value="funcionario" <?= $user['nivel_acesso'] === 'funcionario' ? 'selected' : '' ?>>Funcionário</option>
          <option value="admin" <?= $user['nivel_acesso'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
        </select>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-warning text-dark fw-semibold py-2 rounded-3">
          Salvar Alterações
        </button>
      </div>

      <div class="text-center mt-3">
        <a href="index.php" class="text-decoration-none text-primary fw-semibold">← Voltar à lista</a>
      </div>
    </form>
  </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
