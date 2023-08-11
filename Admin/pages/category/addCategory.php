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

// if(isset($name))
    
    
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include '../../layout/top.php' ?>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name">
                <?php if(isset($error["name"])){ ?>
                   <p class="text-danger"> <?php echo $error["name"]; ?></p>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Status</label>
                <br>
                <input type="radio" value="0" name="status" checked>Hết
                <br>
                <input type="radio" value="1" name="status">Còn
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php include '../../layout/footer.php'; ?>