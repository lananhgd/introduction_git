<?php
session_start();
$userName = "";
if (!empty($_GET["name"])) {
  if ($_GET["name"] == "product") {
    $zName = $_GET["name"];
  }
  if ($_GET["name"] == "contact") {
    $zName = $_GET["name"];
  }
} else {
  $zName = "home";
}
if (isset($_SESSION["loginCustomer"])) {
  $userName = $_SESSION["loginCustomer"];
  $aid = $_SESSION["Cusid"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
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
  <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/templatemo-sixteen.css">
  <link rel="stylesheet" href="../assets/css/owl.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <style>
    .form {
      position: relative;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      transition: all 1s;
      width: 50px;
      height: 50px;
      background: white;
      box-sizing: border-box;
      border-radius: 25px;
      border: 4px solid white;
      padding: 5px;
    }

    .inpt {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      ;
      height: 42.5px;
      line-height: 30px;
      outline: 0;
      border: 0;
      display: none;
      font-size: 1em;
      border-radius: 20px;
      padding: 0 20px;
    }

    .fa {
      box-sizing: border-box;
      padding: 13px;
      width: 42.5px;
      height: 42.5px;
      position: absolute;
      top: 0;
      right: 0;
      border-radius: 50%;
      color: #07051a;
      text-align: center;
      font-size: 1.2em;
      transition: all 1s;
    }

    .form:hover {
      width: 200px;
      cursor: pointer;
    }

    .form:hover .inpt {
      display: block;
    }

    .form:hover .fa {
      background: #07051a;
      color: white;
    }

    .btn1:hover {
      background: #23272B;
      color: white !important;
      transition: 0.8s;
    }

    .btn2:hover {
      background: #fff;
      color: black !important;
      transition: 0.8s;
    }
    .dr{
      background: #232323;
    }
    .z{
      color: white;
    }
    .z:hover{
      background: none !important;
      color: red !important;
      transition: 0.4s;
    }
  </style>
</head>

<body>

  <!-- ***** Preloader Start ***** -->
 
  <!-- ***** Preloader End ***** -->

  <!-- Header -->
  <header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <h2>Have fun with the homies </h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php echo $zName == "home" ? "active" : "" ?>">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item <?php echo $zName == "product" ? "active" : "" ?>">
              <a class="nav-link" href="products.php?name=product&id=all&page=1<?php echo $userName !=""?"&aid=$aid":"" ?>&sort=none">Products</a>
            </li>
            <li class="nav-item <?php echo $zName == "contact" ? "active" : "" ?>">
              <a class="nav-link" href="<?php echo $userName !=""?"contact.php?name=contact&aid=$aid":"log.php?cart=cart" ?>">Cart</a>
            </li>
            <li class="nav-item d-flex ">
              <?php if ($userName == "") { ?>
                <a class="nav-link" href="log.php">Log In</a>
              <?php } else { ?>
                <div class="dropdown  ">
                  <a class="dropdown-toggle nav-link nav-item text-light" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $userName ?>
                  </a>
                  <div class="dropdown-menu dr nav-item " aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item z" href="">View Profile</a>
                    <a class="dropdown-item z "  href="">Setting Account</a>
                    <a class="dropdown-item  z " href="logout.php?aid=<?php echo $aid ?>">Log Out</a>
                  </div>
                </div>
              <?php } ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  