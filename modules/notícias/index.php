<?php
require_once('../../init.php');
require_once('functions.php');
session_start();

// Verifica login
if (!isset($_SESSION['user'])) {
    header('Location: ../../login.php');
    exit;
}

// Busca todas as notícias
$noticias = getAllNoticias();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Notícias do Sesc Esports</h2>

        <?php if (in_array($_SESSION['user']['nivel'], ['admin', 'funcionario', 'escritor'])): ?>
            <a href="add.php" class="btn btn-warning text-dark fw-bold">
                + Nova Notícia
            </a>
        <?php endif; ?>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <?php if (empty($noticias)): ?>
                <p class="text-muted">Nenhuma notícia cadastrada até o momento.</p>

            <?php else: ?>
                <table class="table table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Esporte</th>
                            <th>Data/Hora</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($noticias as $noticia): ?>
                        <tr>
                            <td><?php echo $noticia['id']; ?></td>
                            <td><?php echo htmlspecialchars($noticia['titulo']); ?></td>
                            <td><?php echo $noticia['esporte']; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($noticia['data_criacao'])); ?></td>

                            <td class="text-end">

                                <a href="view.php?id=<?php echo $noticia['id']; ?>" 
                                   class="btn btn-sm btn-primary">
                                   Ver
                                </a>

                                <?php if (in_array($_SESSION['user']['nivel'], ['admin', 'funcionario', 'escritor'])): ?>
                                    <a href="edit.php?id=<?php echo $noticia['id']; ?>" 
                                       class="btn btn-sm btn-warning text-dark">
                                       Editar
                                    </a>
                                <?php endif; ?>

                                <?php if (in_array($_SESSION['user']['nivel'], ['admin', 'funcionario'])): ?>
                                    <button 
                                        class="btn btn-sm btn-danger openDeleteModal"
                                        data-url="delete.php?id=<?php echo $noticia['id']; ?>">
                                        Excluir
                                    </button>
                                <?php endif; ?>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </div>
    </div>

</div>

<?php include('../../components/modal/deleteModal.php'); ?>
<script src="../../components/modal/deleteModal.js"></script>

<?php include(FOOTER_TEMPLATE); ?>
