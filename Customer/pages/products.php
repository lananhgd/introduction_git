<?php
include '../layout/header.php';
include '../common/database.php';
$category = mysqli_query($conn, "select * from category");
$sort = $_GET["sort"];
if ($_GET["id"] == 'all') {
  $page = ($_GET["page"] - 1) * 6;
  $z = mysqli_query($conn, "select * from product ");
  if (isset($_GET["sort"])) {
    if ($_GET["sort"] == "new") {
      $sort = $_GET["sort"];
      $product = mysqli_query($conn, "select * from product order by -id limit 6 offset $page");
    } else  if ($_GET["sort"] == "price") {
      $sort = $_GET["sort"];
      $product = mysqli_query($conn, "select * from product  order by price limit 6 offset $page");
    } else if ($_GET["sort"] == "sale") {
      $sort = $_GET["sort"];
      $product = mysqli_query($conn, "select * from product where sale_price > 0 order by sale_price  limit 6 offset $page");
      $z = mysqli_query($conn, "select * from product where sale_price > 0 ");
    } else if ($_GET["sort"] == "still") {
      $sort = $_GET["sort"];
      $product = mysqli_query($conn, "select * from product where status   = 0 order by sale_price  limit 6 offset $page");
      $z = mysqli_query($conn, "select * from product where status   = 0 ");
    } else {
      $product = mysqli_query($conn, "select * from product limit 6 offset $page");
    }
  }
} else {
  $category_id =  $_GET["id"];
  $page = ($_GET["page"] - 1) * 6;
  $product = mysqli_query($conn, "select * from product where category_id = $category_id limit 6 offset $page");
  $z = mysqli_query($conn, "select * from product where category_id = $category_id");
};
if (!empty($_GET)) {
  if (!empty($_GET["search"])) {
    $search = $_GET["search"];
    $page = ($_GET["page"] - 1) * 6;
    $product = mysqli_query($conn, "select * from product WHERE name like '%%$search%%' limit 6 offset $page ");
    $z = mysqli_query($conn, "select * from product WHERE name like '%%$search%%' ");
  }
}
?>

<!-- Page Content -->
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
<div class="products">
  <form class="form" method="GET">
    <input type="hidden" class="hidden" name="sort" value="none" id="">
    <input type="hidden" class="hidden" name="id" value="all" id="">
    <input type="hidden" class="hidden" name="name" value="product">
    <input type="hidden" class="hidden" name="page" value="1">
    <input type="search" class="inpt" name="search" placeholder="Nhập tên ...">
    <button style="background: none; border: none;" type="submit">ㅤ<i class="fa fa-search"></i></button>
  </form>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="filters">
          <ul>
            <li class="active" data-filter="*" style="<?php echo $_GET["id"] == "all" ? " border-bottom:3px solid black; " : " " ?>"><a href="products.php?name=product&id=all&page=1&sort=none" style="color:black">All Products</a></li>
            <?php foreach ($category as $key => $value) { ?>
              <li style="<?php echo $_GET["id"] == $value["id"] ? " border-bottom:3px solid black; " : " " ?>"><a style="color:black" href="products.php?name=product&id=<?php echo $value["id"] ?>&page=1&sort=none"><?php echo $value["name"] ?></a></li>
            <?php } ?>
          </ul>
          <ul class="mt-4">
            <li><a class="btn btn-dark" href="products.php?name=product&id=all&page=1&sort=new" style="color:white" href="">New</a></li>
            <li><a class="btn btn-dark" href="products.php?name=product&id=all&page=1&sort=price" style="color:white" href="">Price</a></li>
            <li><a class="btn btn-dark" href="products.php?name=product&id=all&page=1&sort=sale" style="color:white" href="">Sale Price</a></li>
            <li><a class="btn btn-dark" href="products.php?name=product&id=all&page=1&sort=still" style="color:white" href="">Still</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-12">
        <div class="filters-content">
          <div class="row grid">
            <?php foreach ($product as $key => $value) { ?>
              <div class="col-lg-4 col-md-4 all des">
                <div class="product-item">
                  <a href="about.php?name=about&id=<?php echo $value["id"] ?>"><img style="height: 348px;" src="../../image/<?php echo $value["image"] ?>" alt=""></a>
                  <div class="sold <?php echo $value["status"] == 0 ? "d-none" : "" ?>" style="width:92%;height:348px;position: absolute;top: 0%;left: 4%;background-color: rgba(0, 0, 0, 0.7);">
                    <h1 style="text-align: center;margin-top: 45%; color: white;">SOLD OUT</h1>
                  </div>
                  <div class="down-content">
                    <a>
                      <h4><?php echo $value["name"] ?></h4>
                    </a>
                    <h6> <?php echo $value["sale_price"] == 0 ? `Sale : $value[sale_price] ` : "Sale : $value[sale_price]$" ?></h6>
                    <h5>Price : <?php echo $value["price"] ?>$</h5>
                    <p> <?php echo strlen($value["description"]) < 2 ? "ㅤ" : $value["description"] ?></p>
                    <ul class="stars">
                      <li><a href="about.php?name=about&id=<?php echo $value["id"] ?>" class="btn btn2 btn-dark " style="color:white;">View Detail</a></li>
                    </ul>
                    <span><a class="<?php echo $value["status"] == 0 ? "btn btn-light btn1" : "btn btn-danger text-light btn1" ?> " href="<?php echo $value["status"] == 0 ? "add.php?id=$value[id]" : "sold.php" ?>" style="color: black;border:1px solid gray;"><?php echo $value["status"] == 0 ? "Add To Cart" : "SOLD OUT" ?></a></span>
                  </div>
                </div>
              </div>
            <?php  } ?>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <ul class="pages">
          <?php if (ceil(mysqli_num_rows($z) / 6) > 1) {  ?>
            <?php for ($i = 1; $i <= ceil(mysqli_num_rows($z) / 6); $i++) {  ?>
              <?php if (!isset($_GET["search"])) { ?>
                <li class="<?php echo $_GET["page"] == $i ? "active" : "" ?>"><a href="products.php?name=product&id=<?php echo $_GET["id"] ?>&page=<?php echo $i ?>&sort=<?php echo $sort ?>"><?php echo $i ?></a></li>
              <?php } else { ?>
                <li class="<?php echo $_GET["page"] == $i ? "active" : "" ?>"><a href="products.php?name=product&id=<?php echo $_GET["id"] ?>&page=<?php echo $i ?>&sort=<?php echo $sort ?>&search=<?php echo $search ?> "><?php echo $i ?></a></li>
              <?php } ?>
            <?php   } ?>
          <?php } else { ?>

          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php
include '../layout/footer.php'
?>