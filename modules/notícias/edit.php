<?php
session_start();
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/database.php');
require_once(INC_PATH . '/globalFunctions.php');
require_once(MODULES_PATH . '/categorias/functions.php');
require_once(MODULES_PATH . '/notícias/functions.php');

// 🔒 Controle de acesso simples
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['nivel_acesso'], ['admin', 'escritor'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

// 📌 Obter ID da notícia
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: ' . BASE_URL . '/modules/notícias/index.php');
    exit;
}

// 🔹 Buscar notícia existente
$noticia = find_news_by_id($id);
if (!$noticia) {
    header('Location: ' . BASE_URL . '/modules/notícias/index.php');
    exit;
}

// 🔹 Buscar categorias para select
$categorias = find_all_categories();

// 💾 Atualização da notícia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'titulo' => $_POST['titulo'] ?? '',
        'conteudo' => $_POST['conteudo'] ?? '',
        'categoria_id' => $_POST['categoria_id'] ?? null,
    ];

    $success = update_news($id, $data);

    if ($success) {
        $_SESSION['messages'][] = ['success', 'Notícia atualizada com sucesso!'];
        header('Location: ' . BASE_URL . '/modules/notícias/index.php');
        exit;
    } else {
        $_SESSION['messages'][] = ['danger', 'Erro ao atualizar a notícia.'];
    }
}

include(HEADER_TEMPLATE);
?>

<div class="container mt-5 pt-4">
    <h1 class="mb-4">Editar Notícia</h1>

    <?php
    if (!empty($_SESSION['messages'])) {
        foreach ($_SESSION['messages'] as $msg) {
            echo "<div class='alert alert-{$msg[0]}'>" . htmlspecialchars($msg[1]) . "</div>";
        }
        unset($_SESSION['messages']);
    }
    ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?= htmlspecialchars($noticia['titulo']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="form-select" required>
                <option value="">Selecione uma categoria</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id']; ?>" <?= $cat['id'] == $noticia['categoria_id'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($cat['nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="conteudo" class="form-label">Conteúdo</label>
            <textarea name="conteudo" id="conteudo" rows="8" class="form-control" required><?= htmlspecialchars($noticia['conteudo']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-warning">Atualizar</button>
        <a href="<?= BASE_URL ?>/modules/notícias/index.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
