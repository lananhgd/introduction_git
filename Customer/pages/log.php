<?php
include '../common/database.php';
session_start();
session_destroy();
$error = [];
if (!empty($_POST)) {
    if (empty($_POST["email"])) {
        $error["email"] = "Vui long nhap email";
    } else {
        $email = $_POST["email"];
    };
    if (empty($_POST["password"])) {
        $error["password"] = "Vui long nhap password";
    } else {
        $password = $_POST["password"];
    }
    if ($error == null) {
        $checkAccount = mysqli_query($conn, "SELECT * FROM `account` WHERE email = '$email'");
        $checkPassword = mysqli_fetch_array($checkAccount);
        $x = password_verify($password, $checkPassword["password"]);
        if (mysqli_num_rows($checkAccount) > 0) {
            if ($x == true) {
                foreach ($checkAccount as $key => $value) {
                    $role = $value["role"];
                    $userName = $value["name"];
                    $accountId = $value["id"];
                }
                session_start();
                if ($role == "customer") {
                    $_SESSION["loginCustomer"] = "$userName";
                    $_SESSION["Cusid"] = "$accountId";
                    if (isset($_GET["proid"])) {
                        $proid = $_GET["proid"];
                        $x = mysqli_query($conn, "INSERT INTO `order`(`account_id`, `product_id`) VALUES ($accountId,$proid)");
                        var_dump($x);
                        header("location: contact.php?name=contact&aid=$accountId");
                    } else {
                        header("location: index.php?aid=$accountId");
                    }
                    if (isset($_GET["cart"])) {
                        header("location: contact.php?name=contact&aid=$accountId");
                    }
                } else {
                    $_SESSION["loginAdmin"] = "$userName";
                    $_SESSION["Adminid"] = "$accountId";
                    header("location: ../../Admin/index.php?aid=$accountId");
                }
            }else{
            $error["password"] = "password sai";
            }
        } else { {
            $error["email"] = "Email sai";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Sixteen Clothing HTML Template</title>

    <!-- Bootstrap core CSS -->
    <link href="http://localhost:8080/php/PHP/Customer/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="http://localhost:8080/php/PHP/Customer/assets/css/fontawesome.css">
    <link rel="stylesheet" href="http://localhost:8080/php/PHP/Customer/assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="http://localhost:8080/php/PHP/Customer/assets/css/owl.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

</head>

<body>
    </div>
    <div class="container">
        <form style="width: 400px;margin: 200px auto;" method="POST">
            <div class="form-group">
                <h2 style="text-align: center;">Login</h2>
                <label for="exampleInputEmail1">Email </label>
                <input type="text" class="form-control" name="email" placeholder="Enter email">
                <?php if (isset($error["email"])) { ?>
                 <p class="text-danger">   <?php echo $error["email"]; ?> </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
                <?php if (isset($error["password"])) { ?>
                 <p class="text-danger">   <?php echo $error["password"]; ?> </p>
                <?php } ?>
            </div>
            <button style="width: 100%;height: 40px;" type="submit" class="btn btn-primary mt-3">Login</button>
            <a style="width: 100%;height: 40px;" href="http://localhost:8080/php/PHP/Customer/pages/sign.php" class="btn btn-danger mt-3 text-light">Sign Up</a>
        </form>
    </div>
</body>

</html>