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
?>

<!-- Bootstrap e CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/public/css/usuarios.css" rel="stylesheet">

<div class="container usuarios-container py-5">
  <div class="usuarios-card shadow-lg p-4 rounded-4 mx-auto" style="max-width: 600px;">
    <h2 class="text-center mb-4 text-primary fw-bold">Detalhes do Usuário</h2>

    <div class="mb-3">
      <label class="form-label fw-semibold text-secondary">Nome completo:</label>
      <p class="form-control bg-light border-2"><?= htmlspecialchars($user['nome_completo']) ?></p>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold text-secondary">Email:</label>
      <p class="form-control bg-light border-2"><?= htmlspecialchars($user['email']) ?></p>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold text-secondary">Nível de acesso:</label>
      <p class="form-control bg-light border-2 text-capitalize"><?= htmlspecialchars($user['nivel_acesso']) ?></p>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold text-secondary">Data de criação:</label>
      <p class="form-control bg-light border-2"><?= date('d/m/Y H:i', strtotime($user['data_registro'])) ?></p>
    </div>

    <div class="text-center mt-4 d-flex justify-content-between">
      <a href="index.php" class="btn btn-outline-primary fw-semibold px-4">← Voltar</a>
      <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-warning text-dark fw-semibold px-4">Editar</a>
    </div>
  </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
