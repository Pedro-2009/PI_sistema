<?php
require_once('../../init.php');

// Verifica permissão rapidamente
function requireRole($roles = [])
{
    if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['nivel'], $roles)) {
        header("Location: ../../index.php");
        exit;
    }
}

// Buscar todas categorias
function getAllCategorias()
{
    global $mysqli;
    $sql = "SELECT * FROM categorias ORDER BY nome_categoria ASC";
    return $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
}

// Buscar categoria única
function getCategoria($id)
{
    global $mysqli;
    $id = intval($id);
    return $mysqli->query("SELECT * FROM categorias WHERE id = $id LIMIT 1")->fetch_assoc();
}

// Criar categoria
function addCategoria()
{
    requireRole(['admin', 'funcionario']);
    global $mysqli;

    $nome = mysqli_real_escape_string($mysqli, $_POST['nome_categoria']);

    // evita duplicado
    $exists = $mysqli->query("SELECT id FROM categorias WHERE nome_categoria = '$nome'");
    if ($exists->num_rows > 0) {
        $_SESSION['msg'] = "Essa categoria já existe!";
        $_SESSION['type'] = "danger";
        return;
    }

    if ($mysqli->query("INSERT INTO categorias (nome_categoria) VALUES ('$nome')")) {
        $_SESSION['msg'] = "Categoria cadastrada!";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['msg'] = "Erro ao cadastrar!";
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php");
    exit;
}

// Atualizar categoria
function updateCategoria($id)
{
    requireRole(['admin', 'funcionario']);
    global $mysqli;

    $nome = mysqli_real_escape_string($mysqli, $_POST['nome_categoria']);

    $sql = "UPDATE categorias SET nome_categoria = '$nome' WHERE id = $id";

    if ($mysqli->query($sql)) {
        $_SESSION['msg'] = "Categoria atualizada!";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['msg'] = "Erro ao editar!";
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php");
    exit;
}

// Excluir categoria
function deleteCategoria($id)
{
    requireRole(['admin', 'funcionario']);
    global $mysqli;

    $id = intval($id);

    // impede excluir categorias usadas em notícias
    $check = $mysqli->query("SELECT id FROM noticias WHERE categoria_id = $id LIMIT 1");
    if ($check->num_rows > 0) {
        $_SESSION['msg'] = "Essa categoria está sendo usada em notícias!";
        $_SESSION['type'] = "danger";
        header("Location: index.php");
        exit;
    }

    if ($mysqli->query("DELETE FROM categorias WHERE id = $id")) {
        $_SESSION['msg'] = "Categoria excluída!";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['msg'] = "Erro ao excluir!";
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php");
    exit;
}
