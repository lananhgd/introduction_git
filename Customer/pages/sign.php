<?php
include '../common/database.php';
$error = [];
if (!empty($_POST)) {
    if (empty($_POST["name"])) {
        $error["name"] = "vui long nhap name";
    } else {
        $name = $_POST["name"];
    };
    if (empty($_POST["email"])) {
        $error["email"] = "vui long nhap email";
    } else {
        $email = $_POST["email"];
        $checkEmail = mysqli_query($conn, "select * from account where email = '$email'");
        if (mysqli_num_rows($checkEmail) > 0) {
            $error["email"] = "Email da ton tai";
        }
    };
    if (empty($_POST["password"])) {
        $error["password"] = "vui long nhap password";
    } else {
        $password = $_POST["password"];
    };
    if (empty($_POST["repassword"]) || $_POST["repassword"] != $_POST["password"]) {
        $error["repassword"] = "Mat khau khong trung khop";
    } else {
        $repassword = $_POST["repassword"];
    }
    if ($error == null) {
        $password = password_hash($password,PASSWORD_DEFAULT);
        mysqli_query($conn, "insert into account (name,email,password) values ('$name','$email','$password')");
        header("location: log.php");
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
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

</head>

<body>
    </div>
    <div class="container">
        <form style="width: 400px;margin: 200px auto;" method="post">
            <div class="form-group">
                <h2 style="text-align: center;">Sign In</h2>
                <label>Name </label>
                <input type="text" class="form-control" name="name" placeholder="Name">
                <?php if (isset($error["name"])) { ?>
                 <p class="text-danger">   <?php echo $error["name"]; ?> </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Email </label>
                <input type="text" name="email" class="form-control" placeholder="Email">
                <?php if (isset($error["email"])) { ?>
                    <p class="text-danger">   <?php echo $error["email"]; ?> </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                <?php if (isset($error["password"])) { ?>
                    <p class="text-danger">   <?php echo $error["password"]; ?> </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="repassword" class="form-control" id="exampleInputPassword1" placeholder="Password">
                <?php if (isset($error["repassword"])) { ?>
                    <p class="text-danger">   <?php echo $error["repassword"]; ?> </p>
                <?php } ?>
            </div>
            <button style="width: 100%;height: 40px;" type="submit" class="btn btn-danger mt-3">Sign Up</button>
            <a style="width: 100%;height: 40px;" href="log.php" class="btn btn-primary mt-3 text-light">Log In</a>
        </form>
    </div>
</body>

</html>