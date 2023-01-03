<?php 

$dsn = 'mysql:host=localhost;dbname=jquery_chat';
$username = 'root';
$password = '';
$db = null;
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
