<?php 
    include '../../common/conn.php';
    $data = mysqli_query($conn,"SELECT * FROM `category` ");
    include '../../layout/header.php';
    function remove($id){
        include '../../common/conn.php';
        $data1 = mysqli_query($conn,"SELECT * FROM `category` where id = $id");
        $data1 = mysqli_fetch_array($data1);
        $data3 = mysqli_query($conn,"SELECT * FROM `product` where category_id = $data1[id] ");
        foreach ($data3 as $key => $value) {
          mysqli_query($conn,"DELETE  FROM `order` WHERE product_id = $value[id] ");
          mysqli_query($conn,"DELETE  FROM `cart` WHERE product_id = $value[id] ");
        }
        // mysqli_query($conn,"DELETE  FROM `order` WHERE category_id = $id ");
        mysqli_query($conn,"DELETE  FROM `product` WHERE category_id = $id ");
        mysqli_query($conn,"DELETE  FROM `category` WHERE id = $id ");
        header("Location: showCategory.php");
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
      <th scope="col">Class Name</th>
      <th scope="col">Status</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($data as $key => $value) { ?>
    <tr>
      <th scope="row"><?php echo $value["id"] ?></th>
      <td><?php echo $value["name"] ?></td>
      <td><?php echo ($value["status"]==1) ? 'Con':"Het" ?></td>
      <td>
      <a href='editCategory.php?id=<?php echo $value["id"] ?>' class="btn btn-primary">Update</a>
      <a href='showCategory.php?id=<?php echo $value["id"] ?>' class="btn btn-danger">Remove</a>
      </td>
    </tr>
  <?php } ?>
   
  </tbody>
</table>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include '../../layout/footer.php'; ?>