<?php
require_once("config.php");

if (isset($_POST["create"])) {
    $errmsg = "";

    $nameProduct = $_POST["nameProduct"];
    $priceProduct = $_POST["priceProduct"];
    $stockProduct = ($_POST["stockProduct"] ?? 0);

    $sql = "INSERT INTO products (name_product, price_product, stock_product) VALUES (:nameProduct, :priceProduct, :stockProduct)";
    $stmt = $pdo->prepare($sql);

    $valdat = [
        ":nameProduct" => $nameProduct,
        ":priceProduct" => $priceProduct,
        ":stockProduct" => $stockProduct
    ];

    $save = $stmt->execute($valdat);
    if ($save) {
        header("Location: dashboard.php");
        exit;
    } else {
        $errmsg = "Invalid, Cant add new product";
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
                        <div class="mb-3">
                            <label for="nameProduct" class="form-label">Name Product</label>
                            <input type="text" class="form-control" id="nameProduct" name="nameProduct"
                                placeholder="Type your name product here">
                        </div>
                        <div class="mb-3">
                            <label for="priceProduct" class="form-label">Price Product</label>
                            <input type="number" class="form-control" id="priceProduct" name="priceProduct">
                        </div>
                        <div class="mb-3">
                            <label for="stockProduct" class="form-label">Stock Product</label>
                            <input class="form-control" type="number" id="stockProduct" />
                        </div>
                        <button class="btn btn-outline-primary" type="submit" name="create"
                            value="create">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>