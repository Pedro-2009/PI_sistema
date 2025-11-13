<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/database.php');

/**
 * Retorna todas as categorias ordenadas pelo id decrescente
 */
function find_all_categories() {
    $conn = open_database();
    if (!$conn) return [];

    $sql = "SELECT id, nome_categoria FROM categorias ORDER BY id DESC";
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
 * Retorna uma categoria pelo ID
 */
function find_category_by_id($id) {
    $conn = open_database();
    if (!$conn) return null;

    $stmt = $conn->prepare("SELECT id, nome_categoria FROM categorias WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $category = $result->fetch_assoc();

    $stmt->close();
    close_database($conn);

    return $category ?: null;
}

/**
 * Adiciona uma nova categoria
 */
function add_category($data) {
    $conn = open_database();
    if (!$conn) return false;

    // agora usa nome_categoria
    $stmt = $conn->prepare("INSERT INTO categorias (nome_categoria) VALUES (?)");
    $stmt->bind_param("s", $data['nome_categoria']);

    $success = $stmt->execute();

    $stmt->close();
    close_database($conn);
    return $success;
}

/**
 * Atualiza uma categoria existente
 */
function update_category($id, $data) {
    $conn = open_database();
    if (!$conn) return false;

    // agora usa nome_categoria (e não nome)
    $stmt = $conn->prepare("UPDATE categorias SET nome_categoria = ? WHERE id = ?");
    $stmt->bind_param("si", $data['nome_categoria'], $id);

    $success = $stmt->execute();

    $stmt->close();
    close_database($conn);
    return $success;
}

/**
 * Deleta uma categoria
 */
function delete_category($id) {
    $conn = open_database();
    if (!$conn) return false;

    $stmt = $conn->prepare("DELETE FROM categorias WHERE id = ?");
    $stmt->bind_param("i", $id);

    $success = $stmt->execute();

    $stmt->close();
    close_database($conn);
    return $success;
}
?>
