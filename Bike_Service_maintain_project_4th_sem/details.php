<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.php'; ?>
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
                    <img src="./img/helments.png" alt="helmets"  height="350" width="350">
                </div>
            </div>
            <div class="col-lg-6  p-5">
                <h3 class="pt-5">Helmets</h3>
                <h5 class="text-danger">Rs 2500</h5>
                <h6>Type: <span class="text-secondary">Helmets</span> </h6>
                <ul class="description">
                    <li>This helemts is looking like a....</li>
                    <li>This is Good.</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, dolores.</li>
                </ul>
                <form action="" class="py-3 d-flex gap-3">
                    <button type="submit" class="btn btn-danger">Add To Cart</button>
                    <button type="submit" class="btn btn-danger">Buy Now</button>

                </form>
            </div>
        </div>
    </div>

</section>
<!-- details  section end  -->


<?php include 'footer.php'; ?>


    <!-- Jquery cdn link  -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- script file link  -->
    <script src="./js/main.js"></script>
    
    <!-- bootstrap js link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js
    "></script>
     <!-- owlcarosule js link  -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  </body>
</html>
