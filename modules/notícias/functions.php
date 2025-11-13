<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/database.php');

/**
 * Funções do módulo Notícias
 */

/**
 * Busca todas as notícias
 * @return array
 */
function find_all_news() {
    $conn = open_database();
    if (!$conn) return [];

    $sql = "SELECT n.*, c.nome AS categoria_nome 
            FROM noticias n
            LEFT JOIN categorias c ON n.categoria_id = c.id
            ORDER BY n.id DESC";
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
 * Busca uma notícia pelo ID
 * @param int $id
 * @return array|null
 */
function find_news_by_id($id) {
    $conn = open_database();
    if (!$conn) return null;

    $stmt = $conn->prepare("SELECT * FROM noticias WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $news = $result->fetch_assoc();

    $stmt->close();
    close_database($conn);
    return $news ?: null;
}

/**
 * Adiciona uma nova notícia
 * @param array $data
 * @return bool
 */
function add_news($data) {
    $conn = open_database();
    if (!$conn) return false;

    $sql = "INSERT INTO noticias (titulo, texto, imagem, categoria_id, criado_em) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $data['titulo'], $data['texto'], $data['imagem'], $data['categoria_id']);

    $success = $stmt->execute();

    $stmt->close();
    close_database($conn);
    return $success;
}

/**
 * Atualiza uma notícia existente
 * @param int $id
 * @param array $data
 * @return bool
 */
function update_news($id, $data) {
    $conn = open_database();
    if (!$conn) return false;

    $sql = "UPDATE noticias SET titulo = ?, texto = ?, imagem = ?, categoria_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $data['titulo'], $data['texto'], $data['imagem'], $data['categoria_id'], $id);

    $success = $stmt->execute();

    $stmt->close();
    close_database($conn);
    return $success;
}

/**
 * Exclui uma notícia
 * @param int $id
 * @return bool
 */
function delete_news($id) {
    $conn = open_database();
    if (!$conn) return false;

    $stmt = $conn->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();

    $stmt->close();
    close_database($conn);
    return $success;
}
?>
