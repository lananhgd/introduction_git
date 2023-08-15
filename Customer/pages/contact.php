<?php
include '../layout/header.php';
include '../common/database.php';
$cart = mysqli_query($conn, "SELECT  product.name,`cart`.id ,product.id as proId, product.image ,SUM(product.price) as Total ,SUM(product.sale_price) as TotalAmount, COUNT(cart.product_id) as Quantity FROM `cart` inner JOIN product ON `cart`.product_id = product.id 
WHERE `cart`.`account_id` = $aid
GROUP BY `cart`.product_id order BY -`cart`.id 
");
$a = 0;
$b = 0;
$lastTotal = 0;
foreach ($cart as $key => $value) {
    if($value["TotalAmount"]==0){
        $a+=$value["Total"];
    }else{
        $b += $value["TotalAmount"];
    }
}
$lastTotal=$a+$b;
?>
<div style="height: 150px;"></div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Sale Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cart as $key => $value) { ?>
            <tr>
                <th scope="row"><?php echo $key+1 ?></th>
                <td><?php echo $value["name"] ?></td>
                <td><img style="width: 150px;height: 150px;" src="../../image/<?php echo $value["image"] ?>" alt=""></td>
                <td>$<?php echo $value["Total"] ?></td>
                <td><?php echo $value["TotalAmount"]==0 ?"":"$".$value["TotalAmount"] ?></td>
                <td>
                <span><a href="minus.php?id=<?php  echo $value["id"] ?>" class="btn btn-primary text-light mr-2"><</a></span>
                <?php echo $value["Quantity"] ?>
                <span><a href="plus.php?id=<?php  echo $value["proId"] ?>" class="btn btn-primary text-light ml-2">></a></span>
                </td>
                <td><a href="remove.php?id=<?php  echo $value["proId"] ?>" class="btn btn-danger text-light">Remove</a></td>
            </tr>
        <?php } ?>
    </tbody>

</table>
<a href="checkout.php?total=<?php echo $lastTotal ?>" class="btn btn-primary" style="float: right;margin-right: 170px;">Check Out</a>

<?php if($lastTotal >0){ ?>
<h3 style="float: right; margin-right: 200px;">Last Total : <?php echo "$".$lastTotal ?></h3>
<?php } ?>
<?php
include '../layout/footer.php'
?>