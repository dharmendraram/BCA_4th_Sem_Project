<?php
require 'connection.php';
$sql="SELECT * FROM Products";

$products = $conn->query($sql);

$sql="SELECT * FROM Services";

$services = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
      <?php include 'head.php'; ?>
</head>

<body id="top">
      <?php include 'header.php'; ?>

      <!-- hero section start  -->
      <div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel">
            <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                  <div class="carousel-item active">
                        <img src="./img/hero2.jpg" class="d-block w-100" alt="Hero1">
                  </div>
                  <div class="carousel-item">
                        <img src="./img/hero3.jpg" class="d-block w-100" alt="Hero3">
                  </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                  data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                  data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
            </button>
      </div>
      <!-- hero section end  -->

      <!-- Our Services section start  -->
      <div class="container py-3">
            <div class="row pt-4">
                  <h2 class="text-center mb-0">Our Services</h2>
                  <p class="text-center text-primary pb-4">Service at ...</p>
                  <?php foreach ($services as $key => $service) { ?>
                  <div class="col-lg-3 p-3">
                        <div class="shadow imgbox rounded-4 text-center py-4">
                              <a href="./booking_form.php">
                                    <img src="<?php echo $service['image'] ?>"
                                          alt="<?php echo $service['title'] ?>" width="50" height="50">
                              </a>
                              <p class="mt-3 fs-5">
                                    <a href="./booking_form.php"><?php echo $service['title']; ?></a>
                              </p>
                        </div>
                  </div>
                  <?php } ?>
            </div>
      </div>

      </div>

      <!-- Our Services section end  -->

      <!-- Our Special section start  -->
      <div class="container mb-5 py-4">
            <div class="row pt-3">
                  <h2 class="text-center mb-4">Our Products</h2>
                  <div class="row mb-4">
                        <?php foreach ($products as $key => $product) { ?>
                        <div class="col-lg-3 mb-3 gap-3">
                              <div class="border img-box rounded-2 p-3 text-center">
                                    <a href="./product-detail.php?id=<?php echo $product['id']; ?>">
                                          <img src="<?php echo $product['image'] ?>"
                                                alt="<?php echo $product['name'] ?>" height="150" width="150">
                                    </a>
                                    <p class="mt-3 fs-5">
                                          <a
                                                href="./product-detail.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a>
                                    </p>
                                    <h5 class="text-danger mt-2 fs-5 ">Rs. <?php echo $product['price'] ?></h5>
                              </div>
                        </div>
                        <?php } ?>
                  </div>

            </div>
      </div>
      <?php include 'footer.php'; ?>
</body>

</html>
