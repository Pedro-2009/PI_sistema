<?php
/**
 * DATABASE.PHP
 * ----------------------------
 * Responsável por abrir e fechar a conexão com o banco de dados.
 */

require_once(__DIR__ . '/../config.php');

function open_database() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die('Erro de conexão: ' . $conn->connect_error);
    }

    // Define o charset para evitar problemas com acentos
    $conn->set_charset("utf8mb4");

    return $conn;
}

function close_database($conn) {
    if ($conn) {
        $conn->close();
    }
}
?>
