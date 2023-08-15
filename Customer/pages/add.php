<?php 
    session_start();
    $product_id = $_GET["id"];
    include '../common/database.php';
    if(!isset($_SESSION["loginCustomer"])){
    header("location: log.php?proid=$product_id");
    }else{
    $account_id = $_SESSION["Cusid"];
    $product_id = $_GET["id"];
    $x = mysqli_query($conn,"INSERT INTO `cart`(`account_id`, `product_id`) VALUES ($account_id,$product_id)");
    header("location: products.php?name=product&id=all&page=1&aid=$account_id&sort=none");
    }
?>