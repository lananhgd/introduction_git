<?php 
    session_start();
    include '../common/database.php';
    if(!isset($_SESSION["loginCustomer"])){
    header("location: log.php");
    }else{
    $account_id = $_SESSION["Cusid"];
    $order_id = $_GET["id"];
    $x = mysqli_query($conn,"DELETE FROM `cart` WHERE id = $order_id");
    header("location: contact.php?name=contact&aid=$account_id");
    }
?>