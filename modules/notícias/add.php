<?php
require_once(__DIR__ . '/../../config.php');
require_once(MODULES_PATH . '/notícias/functions.php');
require_once(MODULES_PATH . '/categorias/functions.php');
require_once(INC_PATH . '/header.php');

// Lista categorias e prepara variáveis
$categorias = find_all_categories();
$errors = [];
$success = false;

// Processa formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $resumo = trim($_POST['resumo'] ?? '');
    $conteudo = trim($_POST['conteudo'] ?? '');
    $categoria_id = $_POST['categoria_id'] ?? '';
    $status = $_POST['status'] ?? 'ativo';
    $autor_id = $_SESSION['user']['id'] ?? 1; // padrão, caso não logado
    $imagem = $_FILES['imagem_principal'] ?? null;

    // Validação
    if (empty($titulo)) $errors[] = "O título é obrigatório.";
    if (empty($resumo)) $errors[] = "O resumo é obrigatório.";
    if (empty($conteudo)) $errors[] = "O conteúdo é obrigatório.";
    if (empty($categoria_id)) $errors[] = "Selecione uma categoria.";

    // Upload da imagem principal
    $imagemPath = '';
    if ($imagem && $imagem['error'] === 0) {
        $ext = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
        $nomeArquivo = 'noticia_' . time() . '.' . $ext;
        $destino = PUBLIC_PATH . '/uploads/noticias/' . $nomeArquivo;

        if (move_uploaded_file($imagem['tmp_name'], $destino)) {
            $imagemPath = 'public/uploads/noticias/' . $nomeArquivo;
        } else {
            $errors[] = "Falha ao enviar a imagem.";
        }
    }

    // Se tudo ok → salva no banco
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
            header('Location: index.php');
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

    <?php if ($errors): ?>
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
                  placeholder="Resumo curto da notícia..." required><?= htmlspecialchars($_POST['resumo'] ?? '') ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Conteúdo</label>
        <textarea name="conteudo" class="form-control border-2" rows="6"
                  placeholder="Escreva o conteúdo completo aqui..." required><?= htmlspecialchars($_POST['conteudo'] ?? '') ?></textarea>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label fw-semibold">Categoria</label>
          <select name="categoria_id" class="form-select border-2" required>
            <option value="">Selecione...</option>
            <?php foreach ($categorias as $c): ?>
              <option value="<?= $c['id']; ?>" <?= (($_POST['categoria_id'] ?? '') == $c['id']) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($c['nome_categoria']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label fw-semibold">Status</label>
          <select name="status" class="form-select border-2">
            <option value="ativo" <?= (($_POST['status'] ?? '') === 'ativo') ? 'selected' : ''; ?>>Ativo</option>
            <option value="rascunho" <?= (($_POST['status'] ?? '') === 'rascunho') ? 'selected' : ''; ?>>Rascunho</option>
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
