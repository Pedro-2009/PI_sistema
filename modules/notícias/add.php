<?php
require_once(__DIR__ . '/../../config.php');
require_once(MODULES_PATH . '/notícias/functions.php');
require_once(MODULES_PATH . '/categorias/functions.php'); // Para listar categorias
require_once(INC_PATH . '/header.php'); // Header global

$categorias = find_all_categories(); // Lista categorias disponíveis
$errors = [];
$success = false;

// Processa o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $categoria_id = $_POST['categoria_id'] ?? '';
    $texto = $_POST['texto'] ?? '';
    $imagem = $_FILES['imagem'] ?? null;

    // Valida campos obrigatórios
    if (empty($titulo)) $errors[] = "O título é obrigatório.";
    if (empty($categoria_id)) $errors[] = "A categoria é obrigatória.";
    if (empty($texto)) $errors[] = "O texto é obrigatório.";

    // Processa upload de imagem, se houver
    $imagemPath = '';
    if ($imagem && $imagem['error'] === 0) {
        $ext = pathinfo($imagem['name'], PATHINFO_EXTENSION);
        $nomeArquivo = 'noticia_' . time() . '.' . $ext;
        $destino = PUBLIC_PATH . '/uploads/noticias/' . $nomeArquivo;

        if (move_uploaded_file($imagem['tmp_name'], $destino)) {
            $imagemPath = 'public/uploads/noticias/' . $nomeArquivo;
        } else {
            $errors[] = "Falha ao enviar a imagem.";
        }
    }

    // Se não houver erros, adiciona a notícia
    if (empty($errors)) {
        $success = add_news([
            'titulo' => $titulo,
            'categoria_id' => $categoria_id,
            'texto' => $texto,
            'imagem' => $imagemPath
        ]);
        if ($success) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = "Falha ao salvar a notícia.";
        }
    }
}
?>

<div class="container py-4">
    <h1 class="mb-4">Adicionar Nova Notícia</h1>

    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" id="titulo" name="titulo" class="form-control" value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select id="categoria_id" name="categoria_id" class="form-select">
                <option value="">Selecione</option>
                <?php foreach ($categorias as $c): ?>
                    <option value="<?= $c['id']; ?>" <?= (($_POST['categoria_id'] ?? '') == $c['id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($c['nome_categoria']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="texto" class="form-label">Texto</label>
            <textarea id="texto" name="texto" class="form-control" rows="5"><?= htmlspecialchars($_POST['texto'] ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem (opcional)</label>
            <input type="file" id="imagem" name="imagem" class="form-control">
        </div>

        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Adicionar</button>
        <a href="index.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>

<?php include(INC_PATH . '/footer.php'); ?>
