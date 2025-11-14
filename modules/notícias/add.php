<?php
require_once(__DIR__ . '/../../config.php');
require_once(MODULES_PATH . '/notícias/functions.php');
require_once(MODULES_PATH . '/categorias/functions.php');
require_once(INC_PATH . '/header.php');

if (session_status() === PHP_SESSION_NONE) session_start();

// Impede cadastro sem estar logado
if (!isset($_SESSION['user']['id'])) {
    die("<div class='alert alert-danger text-center mt-4'>Você precisa estar logado para publicar notícias.</div>");
}

$autor_id = intval($_SESSION['user']['id']);
$categorias = find_all_categories();

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- Dados do formulário ---
    $titulo = trim($_POST['titulo'] ?? '');
    $resumo = trim($_POST['resumo'] ?? '');
    $conteudo = trim($_POST['conteudo'] ?? '');
    $categoria_id = intval($_POST['categoria_id'] ?? 0);
    $status = $_POST['status'] ?? 'ativo';

    // Validações
    if (empty($titulo)) $errors[] = "O título é obrigatório.";
    if (empty($resumo)) $errors[] = "O resumo é obrigatório.";
    if (empty($conteudo)) $errors[] = "O conteúdo é obrigatório.";
    if ($categoria_id <= 0) $errors[] = "Selecione uma categoria válida.";

    // Verifica se a categoria realmente existe
    $categoriaExiste = false;
    foreach ($categorias as $c) {
        if ($c['id'] == $categoria_id) {
            $categoriaExiste = true;
            break;
        }
    }
    if (!$categoriaExiste) {
        $errors[] = "Categoria selecionada não existe.";
    }

    // --- Upload da imagem principal ---
    $imagemPath = null;

    if (!empty($_FILES['imagem_principal']) && $_FILES['imagem_principal']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['imagem_principal']['name'], PATHINFO_EXTENSION));
        $nomeArquivo = 'noticia_' . time() . '.' . $ext;

        $destino = PUBLIC_PATH . '/uploads/noticias/' . $nomeArquivo;

        if (move_uploaded_file($_FILES['imagem_principal']['tmp_name'], $destino)) {
            $imagemPath = 'public/uploads/noticias/' . $nomeArquivo;
        } else {
            $errors[] = "Falha ao enviar a imagem.";
        }
    }

    // --- Se tudo OK, insere ---
    if (empty($errors)) {

        $success = add_news([
            'titulo' => $titulo,
            'resumo' => $resumo,
            'conteudo' => $conteudo,
            'imagem_principal' => $imagemPath,
            'categoria_id' => $categoria_id,
            'autor_id' => $autor_id,
            'status' => $status
        ]);

        if ($success) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Erro ao salvar a notícia no banco de dados.";
        }
    }
}
?>

<div class="container py-4">
  <div class="card shadow-lg border-0 p-4 rounded-4 mx-auto" style="max-width: 800px;">
    <h2 class="text-center text-primary fw-bold mb-4">
      <i class="bi bi-plus-circle me-2"></i>Adicionar Nova Notícia
    </h2>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul class="mb-0">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">

      <div class="mb-3">
        <label class="form-label fw-semibold">Título</label>
        <input type="text" name="titulo" class="form-control border-2"
               value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Resumo</label>
        <textarea name="resumo" class="form-control border-2" rows="2"
                  required><?= htmlspecialchars($_POST['resumo'] ?? '') ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Conteúdo</label>
        <textarea name="conteudo" class="form-control border-2" rows="6"
                  required><?= htmlspecialchars($_POST['conteudo'] ?? '') ?></textarea>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label fw-semibold">Categoria</label>
          <select name="categoria_id" class="form-select border-2" required>
            <option value="">Selecione...</option>
            <?php foreach ($categorias as $c): ?>
              <option value="<?= $c['id']; ?>"
                <?= (($_POST['categoria_id'] ?? '') == $c['id']) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($c['nome_categoria']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label fw-semibold">Status</label>
          <select name="status" class="form-select border-2">
            <option value="ativo">Ativo</option>
            <option value="rascunho">Rascunho</option>
          </select>
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label fw-semibold">Imagem Principal</label>
        <input type="file" name="imagem_principal" class="form-control border-2">
      </div>

      <div class="d-flex justify-content-between">
        <a href="index.php" class="btn btn-secondary px-4">
          <i class="bi bi-arrow-left me-1"></i> Cancelar
        </a>
        <button type="submit" class="btn btn-success fw-semibold px-4">
          <i class="bi bi-check-circle me-1"></i> Salvar Notícia
        </button>
      </div>
    </form>
  </div>
</div>

<?php include(INC_PATH . '/footer.php'); ?>
