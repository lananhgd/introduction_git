<?php
include '../../common/conn.php';
include '../../layout/header.php';
$status = 0;
$id =  $_GET["id"];
$error = [];
$errorImage = [];
$data = mysqli_query($conn,"SELECT * FROM `product` where id = $id ");
foreach ($data as $key => $value) {
    $oldName = $value["name"];
    $oldImage= $value["image"];
    $oldStatus = $value["status"];
    $oldPrice = $value["price"];
    $oldSale_price = $value["sale_price"];
    $oldDescription = $value["description"];
    $oldCategory_id = $value["category_id"];
}
$cateId = mysqli_query($conn,"SELECT * FROM `category` where id = $oldCategory_id ");
$cate = mysqli_query($conn,"SELECT * FROM `category`");
if (!empty($_POST)) {
    if (empty($_POST["name"])) {
        $error["name"] = "Ban chua nhap ten";
    } else {
        $name = $_POST["name"];
    }
    if (empty($_POST["status"])) {

    } else {
        $status = $_POST["status"];
    }
    if (empty($_POST["price"])) {
        $error["price"] = "Hay nhap price";
    } else {
        $price = $_POST["price"];
    }
    if ( $_POST["sale_price"] > $_POST["price"] ) {
        $error["sale_price"] = "Gia khuyen mai phai nho hon gia ban";
    } else {
        $sale_price = $_POST["sale_price"];
    }
    if (empty($_POST["description"])) {

    } else {
        $description = $_POST["description"];
    }

    if (empty($_POST["category_id"])) {
        $error["category_id"] = "category_id khong duoc rong";
    } else {
        $category_id = $_POST["category_id"];
    }
    if(isset($_FILES["file"]["name"])){
        $image = $_FILES["file"]["name"];
        $type = $_FILES["file"]["type"];
        $size = $_FILES["file"]["size"];
        if($type == "image/png" || $type == "image/jpg" || $type == "image/jpeg" || $type == "image/jfif" && $ize > 10000000){
            move_uploaded_file($_FILES["file"]["tmp_name"],"../../../image/".$_FILES["file"]["name"]);
        }else{
            $errorImage["image"] = "Khong dung dinh dang anh";
        }
    }else{
            $errorImage["image"] = "Ban chua chon anh";
    }
    if($error == null){
        // mysqli_query($conn,"insert into product(name,image,status,price,sale_price,description,category_id) values ('$name','$image',$status , $price,$sale_price , '$description',$category_id)");
        if($errorImage == null){
            mysqli_query($conn,"update product set name= '$name' , image = '$image',status = $status ,price = $price , sale_price = $sale_price , description = '$description' ,category_id = $category_id where id = $id ");
        }else{
            mysqli_query($conn,"update product set name= '$name' , image = '$oldImage',status = $status ,price = $price , sale_price = $sale_price , description = '$description' ,category_id = $category_id where id = $id");
        }
        header("Location: showProduct.php");
    }else{
        var_dump("Lỗi tùm lum kìa ?");
    }
}

?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include '../../layout/top.php' ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" value="<?php echo $oldName?>" class="form-control" name="name">
                <?php if (isset($error["name"])) { ?>
                    <p class="text-dagner"><?php echo $error["name"]; ?>
      </p>
                <?php } ?>
            </div>
            <img style="width: 200px; height:200px" src="../../../image/<?php echo $oldImage ?>" alt="">
            <div class="form-group">
                <label>Image</label>
                <input type="file"  class="form-control" name="file">
                <?php if (isset($error["image"])) { ?>
                    <p class="text-dagner"><?php echo $error["image"]; ?>
     </p>>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Status</label>
                <br>
                <input type="radio" value="0" name="status" <?php echo $oldStatus==0 ? "checked":"" ?> >Còn
                <br>
                <input type="radio" value="1" name="status" <?php echo $oldStatus==1 ? "checked":"" ?>>Hết
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" value="<?php echo $oldPrice ?>" min=1 class="form-control" name="price">
                <?php if (isset($error["price"])) { ?>
                    <p class="text-dagner"><?php echo $error["price"]; ?>
     </p>>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Sale Price</label>
                <input type="text" min = 0 value="<?php echo $oldSale_price ?>" class="form-control" name="sale_price">
                <?php if (isset($error["sale_price"])) { ?>
                    <p class="text-dagner"><?php echo $error["sale_price"]; ?>
</p>"]; ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" value="<?php echo $oldDescription ?>" class="form-control" name="description">
            </div>
            <div class="form-group">
                <label>Category Name</label>
                <br>
                <select name="category_id">
                <?php foreach ($cateId as $key => $value) { ?>
                    <option value="<?php echo $value["id"] ?>"><?php echo $value["name"] ?></option>
                <?php  } ?>
                <?php foreach ($cate as $key => $value) { ?>
                    <?php if($value["id"]!= $oldCategory_id){ ?>
                    <option value="<?php echo $value["id"] ?>"><?php echo $value["name"] ?></option>
                    <?php } ?>
                <?php  } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php include '../../layout/footer.php'; ?>