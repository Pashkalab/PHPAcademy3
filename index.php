<?php

require 'functions.php';

$dbConfig = [
    'username' => 'root',
    'password' => '',
    'dbname' => 'mvc',
    'host' => 'localhost'
];

$dbConnection = @mysqli_connect(
    $dbConfig['host'], 
    $dbConfig['username'], 
    $dbConfig['password'], 
    $dbConfig['dbname']
);

if (!$dbConnection) {
    die('Error connecting to DB:' . mysqli_connect_error());
}

// $page = !empty($_GET['page']) ? $_GET['page'] : 'default';
$page = requestGet('page', 'default');

$file = "controller/{$page}.php";

if (!file_exists($file)) {
    die('404 - not found');
}

$view = $page;
$action = requestGet('action');

require $file;

ob_start();
require "views/{$view}.phtml";
$content = ob_get_clean();

require 'layout.phtml';