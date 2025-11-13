<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/database.php');
require_once(__DIR__ . '/functions.php');

// Processa o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // OBRIGATÓRIO: nome_categoria vindo do input
    $data = [
        'nome_categoria' => trim($_POST['nome_categoria'] ?? '')
    ];

    if (!empty($data['nome_categoria'])) {
        if (add_category($data)) {
            header("Location: index.php?success=1");
            exit;
        } else {
            $errorMessage = "Erro ao cadastrar categoria!";
        }
    } else {
        $errorMessage = "O campo nome da categoria não pode ficar vazio!";
    }
}
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
    <h1 class="mb-4">Adicionar Categoria</h1>

    <?php if (!empty($errorMessage)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="nome_categoria" class="form-label">Nome da Categoria</label>
            <input type="text" class="form-control" id="nome_categoria" name="nome_categoria" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>

</div>

<?php include(FOOTER_TEMPLATE); ?>
