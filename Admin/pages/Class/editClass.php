<?php
include '../../common/conn.php';
include '../../layout/header.php';
$acc = ["jpg", "jpeg", "png", "jfif"];
$status = 0;
$id =  $_GET["id"];
$error = [];
$data = mysqli_query($conn,"SELECT * FROM `class` where id = $id ");
$oldName = "";
$oldStatus = 0;
foreach ($data as $key => $value) {
    $oldName = $value["name"];
    $oldStatus = $value["status"];
    $oldImage = $value["image"];
}
if (!empty($_POST)) {
    if (empty($_POST["name"])) {
        $error["name"]="Ban chua nhap ten";
    } else {
        $name = $_POST["name"];
    }
    if (empty($_POST["status"])) {
    } else {
        $status = $_POST["status"];
    }
    if (isset($_POST["name"]) && isset($_POST["status"]) && $_POST["name"]!="") {
        if (!empty($_FILES)) {
            if (!empty($_FILES["file"]["name"])) {
                var_dump("rac");
                $path = $_FILES["file"]["name"];
                $arr = explode('.', $path);
                $duoi = "";
                foreach ($arr as $key => $value) {
                    $duoi = $value;
                }
                for ($i = 0; $i < 4; $i++) {
                    if ($duoi == $acc[$i]) {
                        move_uploaded_file($_FILES["file"]["tmp_name"], '../../image/'. $_FILES["file"]["name"]);
                        $image = 'image/'.$path;
                        $insert =  mysqli_query($conn,"UPDATE class SET name='$name',status=$status , image = '$image' WHERE id = $id");
                        header("Location: http://localhost:8080/php/PHP/Admin/pages/class/showClass.php");
                    }
                }
            }else{
                $insert =  mysqli_query($conn,"UPDATE class SET name='$name',status=$status , image = '$oldImage' WHERE id = $id");
                header("Location: http://localhost:8080/php/PHP/Admin/pages/class/showClass.php");
            }
        }
        
    }
}


?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include '../../layout/top.php' ?>
        <form method="POST" enctype='multipart/form-data'>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" value="<?php echo $oldName ?>" name="name">
                <?php if(isset($error["name"])){ ?>
                    <?php echo $error["name"]; ?>
                <?php } ?>
            </div>
            <img  style="width: 100px; height:100px" src="http://localhost:8080/php/PHP/image/<?php echo $oldImage ?>" alt="">
            <br>
            <input type="file" value="<?php $oldImage ?>" name="file">
            <div class="form-group">
                <label>Status</label>
                <br>
                <input type="radio" value="0" name="status" <?php echo ($oldStatus)==0 ? "checked" : "" ?> >Hết
                <br>
                <input type="radio" value="1" name="status"  <?php echo ($oldStatus)==1 ? "checked" : "" ?> >Còn
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php include '../../layout/footer.php'; ?>