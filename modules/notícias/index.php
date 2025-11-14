<?php
require_once(__DIR__ . '/../../config.php');
require_once(MODULES_PATH . '/notícias/functions.php');
require_once(HEADER_TEMPLATE); // Header global

$noticias = find_all_news();
?>

<div class="container py-4">
    <h1 class="mb-4">Gerenciar Notícias</h1>

    <a href="add.php" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle me-1"></i> Adicionar Nova
    </a>

    <?php if (!empty($noticias)): ?>
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Imagem</th>
                    <th>Publicado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($noticias as $n): ?>
                    <tr>
                        <td><?= $n['id']; ?></td>

                        <td><?= htmlspecialchars($n['titulo']); ?></td>

                        <td><?= htmlspecialchars($n['nome_categoria'] ?? 'Sem categoria'); ?></td>

                        <td>
                            <?php if (!empty($n['imagem_principal'])): ?>
                                <img src="<?= BASE_URL . '/public/uploads/noticias/' . $n['imagem_principal']; ?>" alt="Imagem"
                                    width="60" class="rounded">
                            <?php else: ?>
                                <span class="text-muted">Sem imagem</span>
                            <?php endif; ?>
                        </td>

                        <td><?= date('d/m/Y H:i', strtotime($n['data_publicacao'])); ?></td>

                        <td>
                            <a href="view.php?id=<?= $n['id']; ?>" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="edit.php?id=<?= $n['id']; ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <!-- BOTÃO DELETE UNIVERSAL -->
                            <a href="delete.php?id=<?= $n['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir esta notícia?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    <?php else: ?>
        <div class="alert alert-info">Nenhuma notícia encontrada.</div>
    <?php endif; ?>
</div>

<!-- MODAL GLOBAL -->
<?php include COMPONENTS_PATH . '/modal/deleteModal.php'; ?>

<!-- BOOTSTRAP + DELETE JS -->
<script src="<?= BASE_URL ?>/public/js/bootstrap.js"></script>
<script src="<?= BASE_URL ?>/components/modal/deleteModal.js"></script>

<?php require_once(FOOTER_TEMPLATE); ?>