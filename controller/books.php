<?php

// manage all books logic

function loadBooks($dbConnection)
{
    $sql = 'SELECT * FROM book';
    $res = mysqli_query($dbConnection, $sql);
    $books = mysqli_fetch_all($res, MYSQLI_ASSOC);
    
    return $books;
}

function loadBook($dbConnection, $id)
{
    $preparedSql = 'SELECT * FROM book WHERE id = ?';
    $stmt = mysqli_prepare($dbConnection, $preparedSql);
    
    mysqli_stmt_bind_param($stmt, 'i', $id);
    
    mysqli_stmt_execute($stmt);
    
    $res = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_assoc($res);
}

if ($action == 'show' && $id = requestGet('id')) {
    $book = loadBook($dbConnection, $id);
    
    if (!$book) {
        die('Book not found');
    }
    
    $view = 'book_show';
} else {
    $books = loadBooks($dbConnection);
}


