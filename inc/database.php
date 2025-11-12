<?php
/**
 * DATABASE — Conexão MySQL do Sesc Esports
 * ----------------------------------------
 * Responsável por abrir e fechar a conexão com o banco de dados,
 * usando as constantes definidas em config.php.
 */

// 🔹 Garante que o config.php foi carregado
if (!defined('DB_HOST')) {
    require_once(__DIR__ . '/../config.php');
}

/**
 * Abre uma conexão com o banco de dados
 * @return mysqli|false
 */
function open_database()
{
    // Verifica se as constantes do banco estão definidas
    if (!defined('DB_HOST') || !defined('DB_USER') || !defined('DB_PASS') || !defined('DB_NAME')) {
        error_log("❌ As constantes de conexão com o banco não foram definidas corretamente.");
        return false;
    }

    // Cria a conexão com o MySQL
    $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        error_log("Erro de conexão MySQL: " . $conn->connect_error);
        return false;
    }

    // Define o charset para UTF-8
    if (!$conn->set_charset("utf8mb4")) {
        error_log("Erro ao definir charset UTF-8: " . $conn->error);
    }

    return $conn;
}

/**
 * Fecha uma conexão aberta
 * @param mysqli $conn
 */
function close_database($conn)
{
    if ($conn && $conn instanceof mysqli) {
        $conn->close();
    }
}

/**
 * Testa a conexão com o banco de dados (modo debug)
 */
function test_database_connection()
{
    $conn = open_database();
    if ($conn) {
        echo "<div style='color: green; font-weight: bold; text-align:center; margin-top:10px;'>
                ✅ Conexão com o banco de dados bem-sucedida!
              </div>";
        close_database($conn);
    } else {
        echo "<div style='color: red; font-weight: bold; text-align:center; margin-top:10px;'>
                ❌ Erro ao conectar com o banco de dados.
              </div>";
    }
}
?>
