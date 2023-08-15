<?php 
    session_start();
    include '../common/database.php';
    if(!isset($_SESSION["loginCustomer"])){
    header("location: log.php");
    }else{
    $account_id = $_SESSION["Cusid"];
    $proId = $_GET["id"];
    $x = mysqli_query($conn,"DELETE FROM `cart` WHERE product_id = $proId");
    header("location: contact.php?name=contact&aid=$account_id");
    }
?>