<?php 
    session_start();
    include '../common/database.php';
    if(!isset($_SESSION["loginCustomer"])){
    header("location: log.php");
    }else{
    $account_id = $_SESSION["Cusid"];
    $product_id = $_GET["id"];
    $x = mysqli_query($conn,"INSERT INTO `cart`(`account_id`, `product_id`) VALUES ($account_id,$product_id)");
    header("location: contact.php?name=contact&aid=$account_id");
    }
?>