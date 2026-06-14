<?php
require_once("config.php");
if (isset($_SESSION["user"]))
    header("Location: dashboard.php");

if (isset($_POST["login"])) {
    $errmsg = "";

    $usernameOrmail = $_POST["usernameOrmail"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM accounts WHERE username = :username OR email = :email";
    $stmt = $pdo->prepare($sql);

    $valdat = [
        ":username" => $usernameOrmail,
        ":email" => $usernameOrmail,
    ];

    $stmt->execute($valdat);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user;
        header("Location: dashboard.php");
    } else {
        $errmsg = "Invalid Credentials";
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
                <h1 class="fs-3">Login to your account to learn more</h1>
                <p>Dont have account ? <a href="register.php">Register Now</a></p>
                <?php if (!empty($errmsg)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errmsg; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="usernameOrmail" class="form-label">Username or Email Address</label>
                        <input type="text" class="form-control" name="usernameOrmail"
                            placeholder="Type your username or email here">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" name="password" type="password" />
                    </div>
                    <button class="btn btn-primary" type="submit" name="login" value="login">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>