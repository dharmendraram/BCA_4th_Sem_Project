<?php
require 'connection.php';
$sql="SELECT * FROM Categories";

$categories = $conn->query($sql);
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
    include 'head.php';
    ?>
 
 </head>
  <body id="top">
    <?php include 'header.php'; ?>

<!-- product section start  -->
<section class="product">
    <div class="container pb-4">
        <div class="row">
            <div class="col-lg-3">
                <ul class="list-group rounded-0">
                    <li class="list-group-item active fs-5" aria-current="true"><i class="bi bi-list pe-2 fs-5"></i>Categories</li>
                    <?php foreach ($categories as $key => $category) { ?>
                      <li class="list-group-item">
                        <a href="./category-detail.php?id=<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
            </div>
            
            <div class="col-lg-9 p-0 m-0">
                <div class="row">
                    <div class="col-lg-12 p-0">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="./img/b1.jpg" class="d-block w-100 h-50" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="./img/b2.jpg" class="d-block w-100 h-50" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="./img/b3.jpg" class="d-block w-100 h-50"  alt="...">
                              </div>
                            </div>
                            
                          </div>
                    </div>
                    <div class="col-lg-12 p-0 my-2">
                        <img src="./img/banner-img.png" alt=""class="w-100">
                    </div>
                </div>
               
            </div>
        </div>
    </div>

</section>

<!-- banner section start  -->
<section>
  <div class="container pb-5 pt-3">
    <div class="row">
      <h4 class="text-center py-2">Featured Products</h4>
      <div class="col-lg-4">
        <img src="./img/banner9.jpg" alt="" class="w-100">
      </div>
      <div class="col-lg-4">
        <img src="./img/banner6.jpg" alt="" class="w-100" height="183">
      </div>
      <div class="col-lg-4">
        <img src="./img/banner11.jpg" alt="" class="w-100">
      </div>
    </div>
  </div>
</section>

<!-- product section end  -->

<?php include 'footer.php'; ?>



   
  </body>
</html>
