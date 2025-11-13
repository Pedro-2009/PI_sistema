<?php
require_once 'init.php';
require_once MODULES_PATH . '/usuarios/functions.php'; // Certifique-se de ter a função find_user_by_email

// Limpa qualquer mensagem de erro anterior
unset($_SESSION['error']);

$email = trim($_POST['email'] ?? '');
$senha = trim($_POST['password'] ?? '');

if (empty($email) || empty($senha)) {
    $_SESSION['error'] = 'Preencha todos os campos.';
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

// Busca o usuário no banco pelo email
$conn = open_database();
if (!$conn) {
    $_SESSION['error'] = 'Erro ao conectar ao banco de dados.';
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

$stmt = $conn->prepare("SELECT id, nome_completo, email, senha, nivel_acesso FROM usuarios WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
close_database($conn);

if ($user && password_verify($senha, $user['senha'])) {
    // Login correto
    $_SESSION['logged'] = true;
    $_SESSION['user'] = [
        'id' => $user['id'],
        'nome_completo' => $user['nome_completo'],
        'email' => $user['email'],
        'nivel_acesso' => $user['nivel_acesso']
    ];
    header('Location: ' . BASE_URL . '/index.php');
    exit;
} else {
    $_SESSION['error'] = 'Usuário ou senha incorretos!';
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}
