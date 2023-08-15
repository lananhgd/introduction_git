<?php
// session_start();
ob_start();
include '../layout/header.php';
include '../common/database.php';
$error = [];
if(isset($_SESSION["loginCustomer"])){
    $id = $_SESSION["Cusid"];
    $name = $_SESSION["loginCustomer"];
    $total = 0;
    $x = mysqli_query($conn, "select * from `account` where id = $id");
    $data = mysqli_fetch_assoc($x);
    $length = mysqli_query($conn, "select * from `cart` where account_id = $id ");
    $cart = mysqli_query($conn, "SELECT  product.name,`cart`.id ,product.id as proId, product.image ,SUM(product.price) as Total ,SUM(product.sale_price) as TotalAmount,product.description, COUNT(cart.product_id) as Quantity FROM `cart` inner JOIN product ON `cart`.product_id = product.id 
WHERE `cart`.`account_id` = $id
GROUP BY `cart`.product_id order BY -`cart`.id 
");
if (isset($_POST["name"])) {
    $name = $_POST["name"];
} else {
    $error["name"] = "nhap ten";
}
if (isset($_POST["email"])) {
    $email = $_POST["email"];
} else {
    $error["email"] = "nhap email";
}
if (isset($_POST["address"])) {
    $address = $_POST["address"];
} else {
    $error["address"] = "nhap dia chi";
}
if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];
} else {
    $error["address"] = "nhap dia chi";
}
if (isset($_POST["note"])) {
    $note = $_POST["note"];
} else {
    $error["note"] = "nhap dia chi";
}
if ($error == null) {
    $query2 = mysqli_query($conn, "insert into `order`(account_id,phone,address,note,`total`) values('$id','$phone','$address','$note','$_GET[total]')");
    $last_id = mysqli_insert_id($conn);
    foreach ($length as $key => $value) {
        $get = mysqli_query($conn,"select * from product where id = '$value[product_id])'");
        $get = mysqli_fetch_assoc($get);
        $query = mysqli_query($conn, "INSERT INTO `order_detail`(`order_id`, `account_id`, `product_id`, `category_id`) VALUES ($last_id,$id,$value[product_id],$get[category_id])");
    }
    $query3 = mysqli_query($conn, "delete  from `cart` where account_id = $id");
    header("location:products.php?name=product&id=all&page=1&aid=$id&sort=none");
}
}else{
    header("location:log.php");
}


?>
<?php

include '../layout/footer.php';

?>

<!-- Navbar -->
<!-- Navbar -->

<!--Main layout-->
<div class="page-heading products-heading header-text">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="text-content">
                  <h4>new arrivals</h4>
                  <h2>HFWTH products</h2>
              </div>
          </div>
      </div>
  </div>
</div>
<main class="">
  <div class="container wow fadeIn">
      <h2 class="pt-4 h2 text-center">Checkout form</h2>

      <!--Grid row-->
      <div class="row">

          <!--Grid column-->
          <div class="col-md-8 mb-4">

              <!--Card-->
              <div class="card">

                  <!--Card content-->
                  <form class="card-body" method="POST">

                      <!--Grid row-->
                      <div class="row">

                          <!--Grid column-->
                          <div class="col-md-12 mb-2">

                              <!--firstName-->
                              <div class="md-form ">
                                  <label for="firstName" class="">Name</label>
                                  <input type="text" id="firstName" name="name" value="<?php echo $name ?>" class="form-control">
                              </div>

                          </div>
                          <!--Grid column-->

                          <!--Grid column-->
                          <!--Grid column-->

                      </div>
                      <!--Grid row-->

                      <!--Username-->
                      <!--email-->
                      <div class="md-form mb-5">
                          <label for="email" class="">Email</label>
                          <input type="text" id="email" class="form-control" name="email" value="<?php echo $data["email"] ?>" placeholder="Email">
                      </div>
                      <div class="md-form mb-5">
                          <label for="phone" class="">Phone</label>
                          <input type="text" class="form-control" name="phone" placeholder="Phone">
                      </div>

                      <!--address-->
                      <div class="md-form mb-5">
                          <label for="address" class="">Address</label>
                          <input type="text" id="address" name="address" class="form-control" placeholder="Address">
                      </div>
                      <div class="md-form mb-5">
                          <label for="note" class="">Note</label>
                          <textarea type="text" id="note" name="note" class="form-control" placeholder="note" rows="5"></textarea>
                      </div>

                      <!--address-2-->

                      <!--Grid row-->
                      <!--Grid row-->

                      <hr class="mb-4">
                      <button class="btn btn-primary btn-lg btn-block <?php echo $_GET["total"]==0 ? "d-none":"" ?>" type="submit">Continue to checkout</button>

                  </form>

              </div>
              <!--/.Card-->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-4 mb-4">

              <!-- Heading -->
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-muted">Your cart</span>
                  <span class="badge badge-secondary badge-pill">3</span>
              </h4>
              <!-- Cart -->
              <ul class="list-group mb-3 z-depth-1">
                  <?php foreach ($cart as $key => $value) { ?>

                      <li class="list-group-item d-flex justify-content-between lh-condensed">
                          <div>
                              <h6 class="my-0"><?php echo $value["name"] ?></h6>
                              <small>Qty : <?php echo $value["Quantity"] ?></small>
                          </div>
                          <span class="text-muted">$<?php echo $value["TotalAmount"] == 0 ? $value["Total"] : $value["TotalAmount"] ?></span>
                      </li>
                      <p class="d-none">
                          <?php echo $total += $value["Total"] == 0 ? $value["TotalAmount"] : $value["Total"] ?></p>
                  <?php } ?>
                  <li class="list-group-item d-flex justify-content-between">
                      <span>Total (USD)</span>
                      <strong>$<?php echo $_GET['total'] ?></strong>
                  </li>
              </ul>
              <!-- Cart -->

              <!-- Promo code -->

              <!-- Promo code -->

          </div>
          <!--Grid column-->

      </div>
      <!--Grid row-->

  </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small mt-4 wow fadeIn">

  <!--Call to action-->
  <!--/.Call to action-->

  <hr class="my-4">

  <!-- Social icons -->
  <div class="pb-4">
      <a href="https://www.facebook.com/mdbootstrap" target="_blank">
          <i class="fab fa-facebook-f mr-3"></i>
      </a>

      <a href="https://twitter.com/MDBootstrap" target="_blank">
          <i class="fab fa-twitter mr-3"></i>
      </a>

      <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
          <i class="fab fa-youtube mr-3"></i>
      </a>

      <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
          <i class="fab fa-google-plus-g mr-3"></i>
      </a>

      <a href="https://dribbble.com/mdbootstrap" target="_blank">
          <i class="fab fa-dribbble mr-3"></i>
      </a>

      <a href="https://pinterest.com/mdbootstrap" target="_blank">
          <i class="fab fa-pinterest mr-3"></i>
      </a>

      <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
          <i class="fab fa-github mr-3"></i>
      </a>

      <a href="http://codepen.io/mdbootstrap/" target="_blank">
          <i class="fab fa-codepen mr-3"></i>
      </a>
  </div>
  <!-- Social icons -->

  <!--Copyright-->
  <!--/.Copyright-->

</footer>
<!--/.Footer-->
