<?php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/database.php');
require_once(INC_PATH . '/globalFunctions.php');

/**
 * Funções do módulo Usuários
 */

function find_all_users() {
    $conn = open_database();
    if (!$conn) return [];

    $sql = "SELECT * FROM usuarios ORDER BY id DESC";
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

function find_user_by_id($id) {
    $conn = open_database();
    if (!$conn) return null;

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    close_database($conn);
    return $user ?: null;
}

function add_user($data) {
    $conn = open_database();
    if (!$conn) return false;

    $sql = "INSERT INTO usuarios (nome, email, senha, nivel_acesso, criado_em) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    $senha_hash = password_hash($data['senha'], PASSWORD_DEFAULT);
    $stmt->bind_param("ssss", $data['nome'], $data['email'], $senha_hash, $data['nivel_acesso']);

    $success = $stmt->execute();
    $stmt->close();
    close_database($conn);
    return $success;
}

function update_user($id, $data) {
    $conn = open_database();
    if (!$conn) return false;

    $sql = "UPDATE usuarios SET nome = ?, email = ?, nivel_acesso = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $data['nome'], $data['email'], $data['nivel_acesso'], $id);

    $success = $stmt->execute();
    $stmt->close();
    close_database($conn);
    return $success;
}

function delete_user($id) {
    $conn = open_database();
    if (!$conn) return false;

    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();

    $stmt->close();
    close_database($conn);
    return $success;
}
?>
