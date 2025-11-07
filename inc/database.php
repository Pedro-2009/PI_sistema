<?php
/**
 * DATABASE — Conexão MySQL do Sesc Esports
 * ----------------------------------------
 * Responsável por abrir e fechar a conexão com o banco de dados,
 * usando as constantes definidas em config.php.
 */

if (!defined('DB_HOST')) {
    require_once(__DIR__ . '/../config.php');
}

/**
 * Abre uma conexão com o banco de dados
 * @return mysqli|false
 */
function open_database()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        error_log("Erro de conexão: " . $conn->connect_error);
        return false;
    }

    // Define charset padrão para evitar problemas com acentuação
    $conn->set_charset("utf8mb4");

    return $conn;
}

/**
 * Fecha uma conexão aberta
 */
function close_database($conn)
{
    if ($conn && $conn instanceof mysqli) {
        $conn->close();
    }
}

/**
 * Testa a conexão (debug opcional)
 */
function test_database_connection()
{
    $conn = open_database();
    if ($conn) {
        echo "<div style='color: green; font-weight: bold;'>Conexão com o banco bem-sucedida!</div>";
        close_database($conn);
    } else {
        echo "<div style='color: red; font-weight: bold;'>Erro ao conectar com o banco de dados.</div>";
    }
}
