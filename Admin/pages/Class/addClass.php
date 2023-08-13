<?php
include '../../common/conn.php';
include '../../layout/header.php';
$status = 0;
$error = [];
$acc = ["jpg", "jpeg", "png", "jfif"];
if (!empty($_POST)) {
    if (empty($_POST["name"])) {
        $error["name"] = "Ban chua nhap ten";
    } else {

        $name = $_POST["name"];
        $checkName = mysqli_query($conn, "select *from class where name = '$name'");
        $check = mysqli_num_rows($checkName);
        if ($check != 0) {
            $error["name"] = "da ton tai ten";
        } else {
            if (!empty($_FILES)) {
                if (!empty($_FILES["file"]["name"])) {
                    $path = $_FILES["file"]["name"];
                    $arr = explode('.', $path);
                    $duoi = "";
                    foreach ($arr as $key => $value) {
                        $duoi = $value;
                    }
                    if ($duoi == "jpg" || $duoi == "png" || $duoi == "jpeg" || $duoi == "jfif" && $_FILES["file"]["size"] < 1000000000) {
                        move_uploaded_file($_FILES["file"]["tmp_name"], '../../image/' . $_FILES["file"]["name"]);
                        $image = 'image/' . $path;
                        if (isset($_POST["name"]) && isset($_POST["status"])) {
                            $insert =  mysqli_query($conn, "INSERT INTO class(name,image,status) VALUES ('$name','$image',$status)");
                            header("Location: http://localhost:8080/php/PHP/Admin/pages/class/showClass.php");
                        }
                    } else {
                        $error["image"] = "sai dinh dang hoac kich thuoc qua lon";
                    }
                }
            }
        }
    }
    if (empty($_POST["status"])) {
    } else {
        $status = $_POST["status"];
    }
}

// if(isset($name))



?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include '../../layout/top.php' ?>
        <form method="POST" enctype='multipart/form-data'>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name">
                <?php if (isset($error["name"])) { ?>
                    <?php echo $error["name"]; ?>
                <?php } ?>
            </div>
            <input type="file" name="file">
            <br>
            <?php if (isset($error["image"])) { ?>
                <?php echo $error["image"] ?>
            <?php  } ?>
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