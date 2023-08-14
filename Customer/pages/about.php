<?php 
  include '../layout/header.php';
  include '../common/database.php';
  $id = $_GET["id"];
  $data = mysqli_query($conn,"select * from product where id = $id");
  
?>
    <!-- Page Content -->
    <div class="page-heading about-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>about us</h4>
              <h2>our company</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="best-features about-features product-item">
      <div class="container">
        <div class="row">
        <?php foreach ($data as $key => $value) { ?>
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Detail</h2>
            </div>
          </div>
          <div class="col-md-6" >
            <div class="right-image">
              <img  style="width: 300px; height : 300px;border:1px solid gray" src="../../image/<?php echo $value["image"] ?>" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
            <?php  if($value["status"]==1){ ?> 
            <h2>SOLD OUT!</h2>
        <?php  } ?>
             <h4>Name : <?php echo $value["name"] ?> </h4>
            <div style="height:10px;"></div>
            <h4>Price : $ <?php echo $value["sale_price"]==0 ? $value["price"]:$value["sale_price"] ?> </h4>
            <div style="height:10px;"></div>
              <h6>Description : <?php echo $value["description"] ?></h6>
            <div style="height:40px;"></div>
            <div style="height:50px;"></div>
            <span><a class="<?php echo $value["status"]==0 ? "btn btn-light btn1" :"btn btn-danger text-light btn1" ?> " href="<?php echo $value["status"]==0 ? "add.php?id=$value[id]" :"http://localhost:8080/php/PHP/Customer/pages/sold.php" ?>" style="color: black;border:1px solid gray;"><?php echo $value["status"]==0 ? "Add To Cart" :"SOLD OUT" ?></a></span>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php 
  include '../layout/footer.php'
?>