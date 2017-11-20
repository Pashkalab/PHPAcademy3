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

function loadAuthorBooks($dbConnection, $id)
{
    $preparedSql = 'SELECT book.title, book.price FROM book 
                    JOIN author_book ON book.id = author_book.book_id
                    JOIN  author ON author.id = author_book.author_id
                    WHERE author.id = ?';
    $stmt = mysqli_prepare($dbConnection, $preparedSql);

    mysqli_stmt_bind_param($stmt, 'i', $id);

    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_all($res, MYSQLI_ASSOC);
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

if ($action == 'show_books' && $id = requestGet('id')) {
    $author_books = loadAuthorBooks($dbConnection, $id);

    if (!$author_books) {
        die('Authors books not found');
    }
    $view = 'author_books';
} else {
    $authors = loadAuthors($dbConnection);
}