<?php
include '../../common/conn.php';
include '../../layout/header.php';
$status = 0;
$id =  $_GET["id"];
$error = [];
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
        $insert =  mysqli_query($conn,"UPDATE category SET name='$name',status=$status WHERE id = $id");
        header("Location: showCategory.php");
    }
}

$data = mysqli_query($conn,"SELECT * FROM `category` where id = $id ");
$oldName = "";
$oldStatus = 0;
foreach ($data as $key => $value) {
    $oldName = $value["name"];
    $oldStatus = $value["status"];
}
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include '../../layout/top.php' ?>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" value="<?php echo $oldName ?>" name="name">
                <?php if(isset($error["name"])){ ?>
                    <p class="text-danger"><?php  echo $error["name"]; ?></p>
                <?php } ?>
            </div>
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