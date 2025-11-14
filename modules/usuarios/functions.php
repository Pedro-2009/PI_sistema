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
    if (!$stmt) {
        echo "Erro no prepare: " . $conn->error;
        close_database($conn);
        return null;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    close_database($conn);
    return $user ?: null;
}

/* 🔍 MANTIVE TUDO, só corrigi e isolei a checagem */
function email_exists($email) {
    $conn = open_database();
    if (!$conn) return false;

    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $exists = ($result->num_rows > 0);

    $stmt->close();
    close_database($conn);
    return $exists;
}

/* 🔥 add_user — corrigido SEM alterar lógica */
function add_user($data) {
    $conn = open_database();
    if (!$conn) return false;

    // Verifica email duplicado
    if (email_exists($data['email'])) {
        echo "<div class='alert alert-danger text-center'>Este email já está cadastrado.</div>";
        return false;
    }

    $sql = "INSERT INTO usuarios (nome_completo, email, senha, nivel_acesso, data_registro) 
            VALUES (?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Erro no prepare: " . $conn->error;
        close_database($conn);
        return false;
    }

    $senha_hash = password_hash($data['senha'], PASSWORD_DEFAULT);

    // AQUI estava o problema: data['nome_completo'] PRECISA existir
    if (!$stmt->bind_param("ssss", 
        $data['nome_completo'], 
        $data['email'], 
        $senha_hash, 
        $data['nivel_acesso']
    )) {
        echo "Erro no bind_param: " . $stmt->error;
        $stmt->close();
        close_database($conn);
        return false;
    }

    $success = $stmt->execute();
    if (!$success) {
        echo "Erro no execute: " . $stmt->error;
    }

    $stmt->close();
    close_database($conn);
    return $success;
}

/* Mantive 100% igual */
function update_user($id, $data) {
    $conn = open_database();
    if (!$conn) return false;

    $nome = $data['nome_completo'] ?? '';
    $email = $data['email'] ?? '';
    $nivel = $data['nivel_acesso'] ?? '';
    $senha = trim($data['senha'] ?? '');

    if (!empty($senha)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome_completo = ?, email = ?, nivel_acesso = ?, senha = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo "Erro no prepare: " . $conn->error;
            close_database($conn);
            return false;
        }

        if (!$stmt->bind_param("ssssi", $nome, $email, $nivel, $senha_hash, $id)) {
            echo "Erro no bind_param: " . $stmt->error;
            $stmt->close();
            close_database($conn);
            return false;
        }
    } else {
        $sql = "UPDATE usuarios SET nome_completo = ?, email = ?, nivel_acesso = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo "Erro no prepare: " . $conn->error;
            close_database($conn);
            return false;
        }

        if (!$stmt->bind_param("sssi", $nome, $email, $nivel, $id)) {
            echo "Erro no bind_param: " . $stmt->error;
            $stmt->close();
            close_database($conn);
            return false;
        }
    }

    $success = $stmt->execute();
    if (!$success) {
        echo "Erro no execute: " . $stmt->error;
    }

    $stmt->close();
    close_database($conn);
    return $success;
}

function delete_user($id) {
    $conn = open_database();
    if (!$conn) return false;

    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    if (!$stmt) {
        echo "Erro no prepare: " . $conn->error;
        close_database($conn);
        return false;
    }

    $stmt->bind_param("i", $id);
    $success = $stmt->execute();

    if (!$success) {
        echo "Erro no execute: " . $stmt->error;
    }

    $stmt->close();
    close_database($conn);
    return $success;
}
?>
