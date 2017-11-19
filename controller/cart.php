<?php

function loadCart($arrayIds)
{
    $str = file_get_contents('books.txt');
    $books = unserialize($str);
    
    $result = [];
    
    foreach ($books as $book) {
        if (in_array($book['id'], $arrayIds)) {
            $result[] = $book;
        }
    }
    
    return $result;
}

if ($action == 'add' && $id = requestGet('id')) {
    $currentCart = cookieGet('cart', serialize([]));
    $currentCart = unserialize($currentCart);
    $currentCart[] = $id;
    cookieSet('cart', serialize($currentCart));
    var_dump($currentCart);
    redirect('/?page=books');
} 

$currentCart = cookieGet('cart', serialize([]));
$currentCart = unserialize($currentCart);// my cart - list of books

$books = loadCart($currentCart);
