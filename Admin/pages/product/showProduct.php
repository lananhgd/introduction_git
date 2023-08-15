<?php 
    include '../../common/conn.php';
    $data = mysqli_query($conn,"SELECT product.* , category.name as Category_Name FROM product JOIN category ON product.category_id = category.id;");
    include '../../layout/header.php';
    function remove($id){
        include '../../common/conn.php';
        mysqli_query($conn,"DELETE  FROM `order` WHERE product_id = $id ");
        mysqli_query($conn,"DELETE  FROM `cart` WHERE product_id = $id ");
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
      <th scope="col">Image</th>
      <th scope="col">Status</th>
      <th scope="col">Price</th>
      <th scope="col">Sale Price</th>
      <th scope="col">Description</th>
      <th scope="col">Category Name</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($data as $key => $value) { ?>
    <tr>
      <th scope="row"><?php echo $key +1 ?></th>
      <td><?php echo $value["name"] ?></td>
      <td><img style="width: 200px; height:200px" src="../../../image/<?php echo $value["image"] ?>" alt=""></td>
      <td><?php echo ($value["status"]==0) ? "Con":"Het" ?></td>
      <td><?php echo $value["price"] ?></td>
      <td><?php echo $value["sale_price"]==0 ? "" : $value['sale_price']  ?></td>
      <td><?php echo $value["description"] ?></td>
      <td><?php echo $value["Category_Name"] ?></td>
      <td>
      <a href='editProduct.php?id=<?php echo $value["id"] ?>' class="btn btn-primary">Update</a>
      <a href='showProduct.php?id=<?php echo $value["id"] ?>' class="btn btn-danger">Remove</a>
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