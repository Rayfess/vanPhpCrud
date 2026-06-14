<?php
session_start();

$host = "127.0.0.1";
$dbname = "vancrud_db";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage());
}

?>