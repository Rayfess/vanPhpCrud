<?php
require_once("config.php");

if (isset($_POST["register"])) {
    $errmsg = "";

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO accounts (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);

    $valdat = [
        ":username" => $username,
        ":email" => $email,
        ":password" => $password
    ];

    $save = $stmt->execute($valdat);
    if ($save) {
        header("Location: login.php");
        exit;
    } else {
        $errmsg = "Invalid, Cant create account";
        die($errmsg);
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
                <h1 class="fs-3">Lets Create Your Account</h1>
                <p>Already have an account ? <a href="login.php">Login Now</a></p>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Type your username here">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" id="password" />
                    </div>
                    <button class="btn btn-outline-primary" type="submit" name="register"
                        value="register">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>