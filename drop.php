<?php
require_once("config.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $drop = $stmt->execute([$id]);

    if ($drop) {
        header("Location: dashboard.php");
        exit;
    } else {
        $errmsg = "Cant Delete try again later";
        header("Location: dashboard.php");
    }
}

?>