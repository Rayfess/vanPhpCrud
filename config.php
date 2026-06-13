<?php
session_start();

$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "vancrud_db";
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage());
}

?>