<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/globalFunctions.php');
require_once(__DIR__ . '/functions.php');

// Inicia sessão, se necessário
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Busca todas as categorias
$categorias = find_all_categories();

include(HEADER_TEMPLATE);
?>

<div class="container mt-5 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Categorias</h1>
        <a href="add.php" class="btn btn-primary">Adicionar Categoria</a>
    </div>

    <?php if (!empty($categorias)): ?>
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $cat): ?>
                    <tr>
                        <td><?= htmlspecialchars($cat['id']); ?></td>
                        <td><?= htmlspecialchars($cat['nome_categoria']); ?></td>
                        <td>
                            <a href="edit.php?id=<?= $cat['id']; ?>" class="btn btn-sm btn-warning me-1">Editar</a>
                            <a href="delete.php?id=<?= $cat['id']; ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">
                               Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">Nenhuma categoria encontrada.</p>
    <?php endif; ?>
</div>

<?php include(FOOTER_TEMPLATE); ?>
