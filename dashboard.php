<?php
require_once("config.php");
require_once("auth.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vanPhpCrud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
</head>

<body class="bg-light-subtle">
    <div class="container md-col-6 mt-5">
        <div class="container">
            <p>Welcome <?= $_SESSION["user"]["username"] ?></p>
            <p>Exit Dashboard ? <a class="link-danger link-underline-opacity-25 fw-semibold "
                    href="logout.php">Logout</a>
            </p>
            <a class="link-info link-underline-opacity-25 fw-semibold" href="Create.php">Add New Product [+]</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name Product</th>
                    <th scope="col">Price Product</th>
                    <th scope="col">Stock Product</th>
                    <th scope="col">Act</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM products";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $listProduct = $stmt->fetchAll();
                $countProduct = count($listProduct);

                foreach ($listProduct as $prd) {
                    echo "<tr>";

                    echo "<td>" . $prd["id"] . "</td>";
                    echo "<td>" . $prd["name_product"] . "</td>";
                    echo "<td>" . $prd["price_product"] . "</td>";
                    echo "<td>" . $prd["stock_product"] . "</td>";

                    echo "<td>";
                    echo "<a href='update.php?id=" . $prd['id'] . "'><i class='fa-solid fa-pen me-2 text-warning'></i></a>";
                    echo "<a href='drop.php?id=" . $prd['id'] . "'><i class='fa-solid fa-trash text-danger'></i></a>";
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <p>Total Product :
            <?= $countProduct ?>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>