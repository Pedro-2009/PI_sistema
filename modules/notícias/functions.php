<?php

// ---------------------------
// LISTAR TODAS AS NOTÍCIAS
// ---------------------------
function getAllNoticias()
{
    global $db;

    $sql = "SELECT * FROM noticias ORDER BY id DESC";
    $query = mysqli_query($db, $sql);

    $noticias = [];
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $noticias[] = $row;
        }
    }

    return $noticias;
}


// ---------------------------
// BUSCAR NOTÍCIA POR ID
// ---------------------------
function getNoticiaById($id)
{
    global $db;

    $id = intval($id);

    $sql = "SELECT * FROM noticias WHERE id = $id LIMIT 1";
    $query = mysqli_query($db, $sql);

    return ($query && mysqli_num_rows($query) > 0)
        ? mysqli_fetch_assoc($query)
        : null;
}


// ---------------------------
// ADICIONAR NOTÍCIA
// ---------------------------
function addNoticia($titulo, $texto, $imagem, $esporte)
{
    global $db;

    $titulo = limparTexto($titulo);
    $texto = limparTexto($texto);
    $esporte = limparTexto($esporte);
    $imagem = limparTexto($imagem);

    $sql = "INSERT INTO noticias (titulo, texto, imagem, esporte, data_criacao)
            VALUES ('$titulo', '$texto', '$imagem', '$esporte', NOW())";

    return mysqli_query($db, $sql);
}


// ---------------------------
// EDITAR NOTÍCIA
// ---------------------------
function updateNoticia($id, $titulo, $texto, $imagem, $esporte)
{
    global $db;

    $id = intval($id);
    $titulo = limparTexto($titulo);
    $texto = limparTexto($texto);
    $imagem = limparTexto($imagem);
    $esporte = limparTexto($esporte);

    $sql = "UPDATE noticias 
            SET titulo='$titulo', texto='$texto', imagem='$imagem', esporte='$esporte'
            WHERE id = $id";

    return mysqli_query($db, $sql);
}


// ---------------------------
// DELETAR NOTÍCIA
// ---------------------------
function deleteNoticia($id)
{
    global $db;

    $id = intval($id);
    $sql = "DELETE FROM noticias WHERE id = $id";

    return mysqli_query($db, $sql);
}


// ---------------------------
// FUNÇÃO BÁSICA PARA EVITAR ERROS
// ---------------------------
function limparTexto($valor)
{
    global $db;
    return mysqli_real_escape_string($db, trim($valor));
}

?>
