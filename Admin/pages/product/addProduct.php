<?php
include '../../common/conn.php';
include '../../layout/header.php';
$status = 0;
$error = [];
$data = mysqli_query($conn,"SELECT * FROM `category` ");
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
            $error["image"] = "Khong dung dinh dang anh";
        }
    }else{
            $error["image"] = "Ban chua chon anh";
    }
    if($error == null){
        $x= 1;
        mysqli_query($conn,"insert into product(name,image,status,price,sale_price,description,category_id) values ('$name','$image',$status , $price,$sale_price , '$description',$category_id)");
        header("location: showProduct.php");
    }else{
        $x=0;
    }
}

?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include '../../layout/top.php' ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name">
                <?php if (isset($error["name"])) { ?>
                    <p class="text-danger"> <?php echo $error["name"]; ?>
            </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" name="file">
                <?php if (isset($error["image"])) { ?>
                    <p class="text-danger"> <?php echo $error["image"]; ?>
           </p>>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Status</label>
                <br>
                <input type="radio" value="0" name="status" checked>Hết
                <br>
                <input type="radio" value="1" name="status">Còn
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" min=1 class="form-control" name="price">
                <?php if (isset($error["price"])) { ?>
                    <p class="text-danger"> <?php echo $error["price"]; ?>
           </p>>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Sale Price</label>
                <input type="text" min = 0 value="0" class="form-control" name="sale_price">
                <?php if (isset($error["sale_price"])) { ?>
                    <p class="text-danger"> <?php echo $error["sale_price"]; ?>
      </p>"]; ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" value=" " class="form-control" name="description">
            </div>
            <div class="form-group">
                <label>Category Name</label> 
                <br>
                <select name="category_id">
                <?php foreach ($data as $key => $value) { ?>
                    <option value="<?php echo $value["id"] ?>"><?php echo $value["name"] ?></option>
                <?php  } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
    <?php include '../../layout/footer.php'; ?>