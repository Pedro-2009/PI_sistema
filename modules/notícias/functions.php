<?php
// /modules/notícias/functions.php
require_once(__DIR__ . '/../../config.php');
require_once(INC_PATH . '/database.php');

/**
 * BUSCA TODAS AS NOTÍCIAS (retorna mysqli_result ou null)
 */
function find_all_news() {
    $conn = open_database();
    if (!$conn) return null;

    $sql = "
        SELECT
            n.id,
            n.titulo,
            n.resumo,
            n.conteudo,
            n.imagem_principal,
            n.data_publicacao,
            n.visualizacoes,
            n.status,
            n.autor_id,
            n.categoria_id,
            c.nome_categoria
        FROM noticias n
        LEFT JOIN categorias c ON c.id = n.categoria_id
        ORDER BY n.data_publicacao DESC
    ";

    $result = $conn->query($sql);
    // NÃO fechamos a conexão aqui se você pretende usar $result -> fetch_assoc() fora.
    // Mas para segurança, retornaremos o result (ou null) e deixe a página decidir quando fechar.
    if ($result === false) {
        // log de erro opcional: error_log($conn->error);
        close_database($conn);
        return null;
    }

    // Nota: o chamador pode usar $result->num_rows e $result->fetch_assoc()
    return $result;
}

/**
 * BUSCA NOTÍCIA POR ID (retorna array associativo ou null)
 */
function find_news_by_id($id) {
    $conn = open_database();
    if (!$conn) return null;

    $sql = "
        SELECT
            n.id,
            n.titulo,
            n.resumo,
            n.conteudo,
            n.imagem_principal,
            n.data_publicacao,
            n.visualizacoes,
            n.status,
            n.autor_id,
            n.categoria_id,
            c.nome_categoria
        FROM noticias n
        LEFT JOIN categorias c ON c.id = n.categoria_id
        WHERE n.id = ?
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        close_database($conn);
        return null;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res ? $res->fetch_assoc() : null;

    $stmt->close();
    close_database($conn);

    return $row ?: null;
}

/**
 * ADICIONA UMA NOTÍCIA (recebe array com keys: titulo,resumo,conteudo,imagem_principal,autor_id,categoria_id)
 * Retorna true/false
 */
function add_news(array $data) {
    $conn = open_database();
    if (!$conn) return false;

    $sql = "
        INSERT INTO noticias
            (titulo, resumo, conteudo, imagem_principal, data_publicacao, visualizacoes, status, autor_id, categoria_id)
        VALUES
            (?, ?, ?, ?, NOW(), 0, 'ativo', ?, ?)
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        close_database($conn);
        return false;
    }

    $titulo = $data['titulo'] ?? '';
    $resumo = $data['resumo'] ?? '';
    $conteudo = $data['conteudo'] ?? '';
    $imagem = $data['imagem_principal'] ?? null; // pode ser null ou nome do arquivo
    $autor_id = !empty($data['autor_id']) ? intval($data['autor_id']) : null;
    $categoria_id = !empty($data['categoria_id']) ? intval($data['categoria_id']) : null;

    // Garante que autor_id e categoria_id sejam inteiros (ou NULL)
    if ($autor_id === null) $autor_id = 0;
    if ($categoria_id === null) $categoria_id = 0;

    $stmt->bind_param("ssssii",
        $titulo,
        $resumo,
        $conteudo,
        $imagem,
        $autor_id,
        $categoria_id
    );

    $success = $stmt->execute();

    $stmt->close();
    close_database($conn);

    return (bool) $success;
}

/**
 * ATUALIZA UMA NOTÍCIA (recebe id e array semelhante ao add_news)
 * Retorna true/false
 */
function update_news($id, array $data) {
    $conn = open_database();
    if (!$conn) return false;

    $sql = "
        UPDATE noticias SET
            titulo = ?,
            resumo = ?,
            conteudo = ?,
            imagem_principal = ?,
            categoria_id = ?,
            status = ?
        WHERE id = ?
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        close_database($conn);
        return false;
    }

    $titulo = $data['titulo'] ?? '';
    $resumo = $data['resumo'] ?? '';
    $conteudo = $data['conteudo'] ?? '';
    $imagem = $data['imagem_principal'] ?? $data['imagem'] ?? null;
    $categoria_id = !empty($data['categoria_id']) ? intval($data['categoria_id']) : 0;
    $status = $data['status'] ?? 'ativo';
    $id = intval($id);

    $stmt->bind_param(
        "ssssis i",
        $titulo,
        $resumo,
        $conteudo,
        $imagem,
        $categoria_id,
        $status,
        $id
    );

    // OBS: alguns servidores php+mysqli estrito podem não aceitar espaço no types string;
    // Para máxima compatibilidade substituímos por tipo correto abaixo:
    // tipos esperados: s,s,s,s,i,s,i => "ssssisi"
    $stmt->close();

    // Re-prepare com tipos corretos (evita problemas em servidores restritos)
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        close_database($conn);
        return false;
    }
    $stmt->bind_param(
        "ssssisi",
        $titulo,
        $resumo,
        $conteudo,
        $imagem,
        $categoria_id,
        $status,
        $id
    );

    $success = $stmt->execute();

    $stmt->close();
    close_database($conn);

    return (bool) $success;
}

/**
 * REMOVE UMA NOTÍCIA
 */
function delete_news($id) {
    $conn = open_database();
    if (!$conn) return false;

    $stmt = $conn->prepare("DELETE FROM noticias WHERE id = ? LIMIT 1");
    if (!$stmt) {
        close_database($conn);
        return false;
    }

    $id = intval($id);
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();

    $stmt->close();
    close_database($conn);

    return (bool) $success;
}

/**
 * BUSCA SÓ NOTÍCIAS ATIVAS (retorna mysqli_result ou null)
 */
function find_all_news_ativas() {
    $conn = open_database();
    if (!$conn) return null;

    $sql = "SELECT * FROM noticias WHERE status = 'ativo' ORDER BY data_publicacao DESC";
    $result = $conn->query($sql);

    if ($result === false) {
        close_database($conn);
        return null;
    }

    return $result;
}

/**
 * RETORNA NOME DA CATEGORIA (string)
 */
function get_category_name($id) {
    $conn = open_database();
    if (!$conn) return 'Sem categoria';

    $stmt = $conn->prepare("SELECT nome_categoria FROM categorias WHERE id = ? LIMIT 1");
    if (!$stmt) {
        close_database($conn);
        return 'Sem categoria';
    }

    $id = intval($id);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res ? $res->fetch_assoc() : null;

    $stmt->close();
    close_database($conn);

    return $row['nome_categoria'] ?? 'Sem categoria';
}

/**
 * RETORNA NOME DO AUTOR (string)
 */
function get_author_name($id) {
    $conn = open_database();
    if (!$conn) return 'Autor desconhecido';

    $stmt = $conn->prepare("SELECT nome_completo FROM usuarios WHERE id = ? LIMIT 1");
    if (!$stmt) {
        close_database($conn);
        return 'Autor desconhecido';
    }

    $id = intval($id);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res ? $res->fetch_assoc() : null;

    $stmt->close();
    close_database($conn);

    return $row['nome_completo'] ?? 'Autor desconhecido';
}

/**
 * INCREMENTA VISUALIZAÇÕES (void)
 */
function increment_news_views($id) {
    $conn = open_database();
    if (!$conn) return;

    $stmt = $conn->prepare("UPDATE noticias SET visualizacoes = visualizacoes + 1 WHERE id = ?");
    if (!$stmt) {
        close_database($conn);
        return;
    }

    $id = intval($id);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    close_database($conn);
}
