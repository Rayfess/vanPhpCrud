<?php
require_once("config.php");

$id = $_GET["id"];

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$listProduct = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$listProduct) {
    $errmsg = "Theres no product yet";
    header("Location: dashboard.php");
}

if (isset($_POST["update"])) {
    $errmsg = "";

    $id = $_POST["id"];
    $nameProduct = $_POST["nameProduct"];
    $priceProduct = $_POST["priceProduct"];
    $stockProduct = (!isset($_POST["stockProduct"]) || $_POST["stockProduct"] === "" ? 0 : $_POST["stockProduct"]);

    $sql = "UPDATE products SET name_product = :nameProduct, price_product = :priceProduct, stock_product = :stockProduct WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $valdat = [
        ":id" => $id,
        ":nameProduct" => $nameProduct,
        ":priceProduct" => $priceProduct,
        ":stockProduct" => $stockProduct
    ];

    $save = $stmt->execute($valdat);
    if ($save) {
        header("Location: dashboard.php");
        exit;
    } else {
        $errmsg = "Invalid, Cant update product";
        header("Location: dashboard.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vanilla Basic Crud PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="fs-3">Lets Add Your Product</h1>
                <div class="mt-3">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $listProduct['id'] ?>" />
                        <div class="mb-3">
                            <label for="nameProduct" class="form-label">Name Product</label>
                            <input type="text" class="form-control" id="nameProduct" name="nameProduct"
                                value="<?= $listProduct["name_product"] ?>" placeholder="Type your name product here">
                        </div>
                        <div class="mb-3">
                            <label for="priceProduct" class="form-label">Price Product</label>
                            <input type="number" class="form-control" id="priceProduct" name="priceProduct"
                                value="<?= $listProduct["price_product"] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="stockProduct" class="form-label">Stock Product</label>
                            <input class="form-control" type="number" name="stockProduct" id="stockProduct"
                                value="<?= ($listProduct["stock_product"] ?? 0) ?>" />
                        </div>
                        <button class="btn btn-warning" type="submit" name="update" value="update">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>