<?php
require_once(__DIR__ . '/../../init.php');
require_once(__DIR__ . '/functions.php');
include(HEADER_TEMPLATE);

// Busca todos os usuários
$usuarios = find_all_users();
?>

<!-- Bootstrap (link padrão do projeto) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/public/css/usuarios.css" rel="stylesheet">

<div class="container usuarios-container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-primary">Gerenciar Usuários</h1>
    <a href="add.php" class="btn btn-warning fw-semibold text-dark px-3">+ Novo Usuário</a>
  </div>

  <?php if (!empty($usuarios)) : ?>
    <div class="table-responsive shadow rounded-4">
      <table class="table table-striped align-middle mb-0">
        <thead class="table-warning text-center">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Nível de Acesso</th>
            <th>Criado em</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php foreach ($usuarios as $user) : ?>
            <tr>
              <td><?= $user['id'] ?></td>
              <td><?= htmlspecialchars($user['nome_completo']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td>
                <span class="badge 
                  <?= $user['nivel_acesso'] === 'admin' ? 'bg-danger' : 
                      ($user['nivel_acesso'] === 'funcionario' ? 'bg-primary' :
                      ($user['nivel_acesso'] === 'escritor' ? 'bg-success' : 'bg-secondary')) ?>">
                  <?= ucfirst($user['nivel_acesso']) ?>
                </span>
              </td>
              <td><?= date('d/m/Y H:i', strtotime($user['data_registro'])) ?></td>
              <td>
                <a href="view.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary">Ver</a>
                <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
                <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger"
                   onclick="return confirm('Deseja realmente excluir este usuário?')">Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else : ?>
    <div class="alert alert-info text-center mt-4">Nenhum usuário cadastrado.</div>
  <?php endif; ?>
</div>

<?php include(FOOTER_TEMPLATE); ?>
