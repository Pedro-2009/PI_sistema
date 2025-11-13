<?php
require_once(__DIR__ . '/../../init.php');
// requireAccess([]); // removido pois não existe

require_once(MODULES_PATH . '/comentarios/functions.php');
$comentarios = find_all_comments();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
    <h1 class="mb-4">Comentários</h1>
    <hr>

    <?php if (!empty($comentarios)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Autor</th>
                        <th>Notícia</th>
                        <th>Conteúdo</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comentarios as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['autor_nome'] ?? 'Desconhecido') ?></td>
                            <td><?= htmlspecialchars($c['noticia_titulo'] ?? 'Sem notícia') ?></td>
                            <td><?= htmlspecialchars($c['conteudo']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($c['criado_em'])) ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>/modules/comentarios/edit.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-warning mb-1">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>

                                <button class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $c['id'] ?>" data-item="comentário">
                                    <i class="bi bi-trash"></i> Excluir
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Nenhum comentário encontrado.</div>
    <?php endif; ?>
</div>

<!-- Modal de exclusão -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir este <span id="itemName"></span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Excluir</a>
      </div>
    </div>
  </div>
</div>

<script>
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const item = button.getAttribute('data-item');
        document.getElementById('itemName').textContent = item;
        document.getElementById('confirmDeleteBtn').href = `<?= BASE_URL ?>/modules/comentarios/delete.php?id=${id}`;
    });
</script>

<?php include(FOOTER_TEMPLATE); ?>
