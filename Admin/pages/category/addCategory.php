<?php
include '../../common/conn.php';
include '../../layout/header.php';
$status = 0;
$error = [];
if (!empty($_POST)) {
    if (empty($_POST["name"])) {
        $error["name"]="Ban chua nhap ten";
    } else {
        
        $name = $_POST["name"];
        $checkName = mysqli_query($conn,"select *from category where name = '$name'");
        $check = mysqli_num_rows($checkName);
        if (empty($_POST["status"])) {
        } else {
            $status = $_POST["status"];
        }
        if($check !=0){
            $error["name"] = "da ton tai ten";
        }else{
            if (isset($_POST["name"]) && isset($_POST["status"])) {
                $insert =  mysqli_query($conn,"INSERT INTO category(name,status) VALUES ('$name',$status)");
                header("Location: showCategory.php");
            }
        }
    }
    
}