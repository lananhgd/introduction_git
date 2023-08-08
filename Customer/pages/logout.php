<?php 
    session_start();
    if($_GET["aid"]==$_SESSION["Cusid"]){
        header("location: index.php");
        // session_unset("aid");
        unset($_SESSION["loginCustomer"]);
        unset($_SESSION["Cusid"]);
    }else{
        header("location: log.php");
        unset($_SESSION["loginAdmin"]);
        unset($_SESSION["Adminid"]);
    }
?>