<?php
require 'connection.php';

$productId = $_GET['id'];

$sql="SELECT p.name,p.image,p.quantity,p.price,p.description,c.category_name
FROM Products p
JOIN Categories c
ON p.category_id=c.id WHERE p.id = $productId";
$product=$conn->query($sql);
$product = $product->fetch_assoc();

?>






<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include 'head.php'?>
 </head>
  <body id="top">
    <?php include 'header.php'; ?>

  <!-- hero section start  -->
  <section class="inner-page pt-5" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-7 content">
          <h1 class="text-white font-weight-bold">Details</h1>
          <div class="custom-breadcrumbs">
            <a href="index.php" class="text-light fw-bold">Home</a><span class="mx-2 slash">/</span>
            <span class="text-white"><strong>Details</strong></span>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- hero section end  -->

<!-- details section start  -->
<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="card border-0 shadow rounded-3 align-items-center p-5">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name'] ?>"  height="350" width="350">
                </div>
            </div>
            <div class="col-lg-6  p-5">
                <h3 class="pt-5"><?php echo $product['name'] ?></h3>
                <h5 class="text-danger">Rs. <?php echo $product['price'] ?></h5>
                <h6>Type: <span class="text-secondary"><?php echo $product['category_name'] ?></span> </h6>
                <ul class="description">
                <?php echo $product['description'] ?>
                </ul>
                <form action="" class="py-3 d-flex gap-3">
                   <!-- <button type="submit" class="btn btn-danger">Add To Cart</button> -->
                    <a class="btn btn-danger" href="orders_form.php?oid=<?php echo $productId; ?>">Buy Now</a>

                </form>
            </div>
        </div>
    </div>

</section>
<!-- details  section end  -->


<?php include 'footer.php'; ?>



  </body>
</html>
