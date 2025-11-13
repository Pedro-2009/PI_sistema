<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/database.php');

/**
 * Retorna todos os comentários
 */
function find_all_comments() {
    $conn = open_database();
    if (!$conn) return [];

    $sql = "SELECT c.*, u.nome AS autor_nome, n.titulo AS noticia_titulo
            FROM comentarios c
            LEFT JOIN usuarios u ON c.usuario_id = u.id
            LEFT JOIN notícias n ON c.noticia_id = n.id
            ORDER BY c.criado_em DESC";

    $result = $conn->query($sql);
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    close_database($conn);
    return $data;
}

/**
 * Buscar comentário por ID
 */
function find_comment_by_id($id) {
    $conn = open_database();
    if (!$conn) return null;

    $stmt = $conn->prepare("SELECT * FROM comentarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $comment = $res->fetch_assoc();

    $stmt->close();
    close_database($conn);
    return $comment ?: null;
}

/**
 * Adicionar comentário
 */
function add_comment($data) {
    $conn = open_database();
    if (!$conn) return false;

    $stmt = $conn->prepare("INSERT INTO comentarios (usuario_id, noticia_id, conteudo, criado_em) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iis", $data['usuario_id'], $data['noticia_id'], $data['conteudo']);

    $success = $stmt->execute();
    $stmt->close();
    close_database($conn);
    return $success;
}

/**
 * Atualizar comentário
 */
function update_comment($id, $conteudo) {
    $conn = open_database();
    if (!$conn) return false;

    $stmt = $conn->prepare("UPDATE comentarios SET conteudo = ? WHERE id = ?");
    $stmt->bind_param("si", $conteudo, $id);

    $success = $stmt->execute();
    $stmt->close();
    close_database($conn);
    return $success;
}

/**
 * Deletar comentário
 */
function delete_comment($id) {
    $conn = open_database();
    if (!$conn) return false;

    $stmt = $conn->prepare("DELETE FROM comentarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    $success = $stmt->execute();
    $stmt->close();
    close_database($conn);
    return $success;
}
