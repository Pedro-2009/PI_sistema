<?php
require_once 'init.php';

$email = trim($_POST['email'] ?? '');
$pass  = trim($_POST['password'] ?? '');

if (check_login($email, $pass)) {
    $_SESSION['logged'] = true;
    header('Location: index.php');
} else {
    $_SESSION['error'] = 'Usuário ou senha incorretos!';
    header('Location: login.php');
}
exit;
?>
