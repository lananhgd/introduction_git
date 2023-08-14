<?php
include '../../common/conn.php';
include '../../layout/header.php';
$data = mysqli_query($conn, "
SELECT  product.name , product.image ,SUM(product.price) as Total ,SUM(product.sale_price) as TotalAmount, COUNT(order_detail.product_id) as Quantity 
FROM `order_detail` inner JOIN product ON `order_detail`.product_id = product.id 
WHERE `order_detail`.`account_id` = $_GET[uid] and `order_detail`.`order_id` = $_GET[id]
GROUP BY `order_detail`.product_id order BY -`order_detail`.id  ");
$check = mysqli_query($conn,"select * from `order` where id = $_GET[id]");
$check2 = mysqli_fetch_assoc($check);
$status = $check2["status"];
if(isset($_POST["status"])){
    mysqli_query($conn,"update `order` set status = $_POST[status] where id ='$_GET[id]'");
    header("location:order.php");
}
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include '../../layout/top.php' ?>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $value) { ?>
                    <tr>
                        <td scope="col"><?php echo $key + 1 ?></td>
                        <td scope="col"><?php echo $value["name"] ?></td>
                        <td scope="col">$<?php echo $value["TotalAmount"] == 0 ? $value["Total"] : $value["TotalAmount"] ?></td>
                        <td scope="col"><?php echo $value["Quantity"] ?></td>
                    </tr>
                <?php    } ?>
            </tbody>
            <tbody>
                <tr>
                    <form method="post">
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option class="text-danger " <?php echo $status==0 ? "selected":""  ?> value="0">Chua xu li</option>
                            <option class="text-warning " <?php echo $status==1 ? "selected":""  ?> value="1">Da xu li</option>
                            <option class="text-primary " <?php echo $status==2 ? "selected":""  ?> value="2">Dang giao hang</option>
                            <option class="text-success " <?php echo $status==3 ? "selected":""  ?> value="3">Da Nhan hang</option>
                        </select>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </td>
                    </form>
                </tr>
            </tbody>
        </table>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php include '../../layout/footer.php'; ?>