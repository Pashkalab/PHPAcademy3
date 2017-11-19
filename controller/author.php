<?php


function loadAuthors($dbConnection)
{
    $sql = 'SELECT * FROM author';
    $res = mysqli_query($dbConnection, $sql);
    $authors = mysqli_fetch_all($res, MYSQLI_ASSOC);

    return $authors;
}


function loadAuthor($dbConnection, $id)
{
    $preparedSql = 'SELECT * FROM author WHERE id = ?';
    $stmt = mysqli_prepare($dbConnection, $preparedSql);

    mysqli_stmt_bind_param($stmt, 'i', $id);

    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($res);
}

if ($action == 'show' && $id = requestGet('id')) {
    $author = loadAuthor($dbConnection, $id);

    if (!$author) {
        die('Author not found');
    }

    $view = 'author_show';
} else {
    $authors = loadAuthors($dbConnection);
}
