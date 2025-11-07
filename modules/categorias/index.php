<?php
require_once('../../init.php');
require_once('functions.php');
session_start();

requireRole(['admin', 'funcionario', 'escritor']);

$categorias = getAllCategorias();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Categorias</h2>

        <?php if (in_array($_SESSION['user']['nivel'], ['admin', 'funcionario'])): ?>
            <a href="add.php" class="btn btn-success">+ Nova Categoria</a>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?>">
            <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
        </div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Categoria</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($categorias as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['nome_categoria']) ?></td>

                <td class="text-end">

                    <a href="view.php?id=<?= $c['id'] ?>" 
                       class="btn btn-primary btn-sm">Ver</a>

                    <?php if (in_array($_SESSION['user']['nivel'], ['admin', 'funcionario'])): ?>
                        <a href="edit.php?id=<?= $c['id'] ?>"
                           class="btn btn-warning btn-sm">Editar</a>

                        <button 
                            class="btn btn-danger btn-sm openDeleteModal"
                            data-url="delete.php?id=<?= $c['id']; ?>">
                            Excluir
                        </button>
                    <?php endif; ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>

<?php include('../../components/modal/deleteModal.php'); ?>
<script src="../../components/modal/deleteModal.js"></script>

<?php include(FOOTER_TEMPLATE); ?>
