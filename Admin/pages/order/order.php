<?php 
    include '../../common/conn.php';
    $data = mysqli_query($conn,"SELECT account.id as uid,account.name ,`order`.`id` ,`order`.`status`,`order`.`total` , `order`.`phone` , `order`.`address` , `order`.`note` FROM `order` JOIN 
account ON account.id = `order`.account_id");
    include '../../layout/header.php';
    function remove($id){
        include '../../common/conn.php';
        mysqli_query($conn,"DELETE  FROM `order` WHERE product_id = $id ");
        mysqli_query($conn,"DELETE  FROM `product` WHERE id = $id ");
        header("Location: showProduct.php");
    }
    if (isset($_GET['id'])) {
            remove($_GET['id']);
    }
?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php  include '../../layout/top.php'?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Status</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">Note</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($data as $key => $value) { ?>
  <tr>
    <td><?php echo $key +1 ?></td>
    <td><?php echo $value["name"] ?></td>
    <?php if($value["status"]==0){ ?>
        <td class="text-danger">Chua Xu li</td>
      <?php } ?>
      <?php if($value["status"]==1){ ?>
        <td class="text-warning">Da Xu li</td>
      <?php } ?>
      <?php if($value["status"]==2){ ?>
        <td class="text-primary">Dang giao hang</td>
      <?php } ?>
      <?php if($value["status"]==3){ ?>
        <td class="text-success">Da nhan hang</td>
      <?php } ?>
      <td><?php echo $value["phone"] ?></td>
      <td><?php echo $value["address"] ?></td>
      <td><?php echo $value["note"] ?></td>
      <td><a class="btn btn-primary" href="order_detail.php?id=<?php echo $value["id"] ?>&uid=<?php echo $value["uid"] ?>">View</a></td>
  </tr>
 <?php } ?>
  </tbody>
</table>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include '../../layout/footer.php'; ?>