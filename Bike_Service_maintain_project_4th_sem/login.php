<!DOCTYPE html>
<html lang="en">

<head>
      <?php include 'head.php'; ?>

</head>

<body id="top">
      <?php include 'header.php'; ?>

      <!-- hero section start  -->
      <section class="inner-page" id="home-section">
            <div class="container">
                  <div class="row">
                        <div class="col-md-7 content">
                              <h1 class="text-white font-weight-bold">Log In</h1>
                              <div class="custom-breadcrumbs">
                                    <a href="index.php" class="text-light fw-bold">Home</a><span
                                          class="mx-2 slash">/</span>
                                    <span class="text-white"><strong>Log In</strong></span>
                              </div>
                        </div>
                  </div>
            </div>
      </section>
      <!-- hero section end  -->

      <!-- form section start  -->
      <section class="form-section py-5">
            <div class="container">
                  <div class="row">
                        <div class="col-md-12 my-5">
                              <form method="POST" action="all_action.php" class="p-4 shadow rounded-4">
                                    <p class="fw-bold fs-4 pt-2">Login</p>
                                    <span class="text-primary">Login to get started with Infnity Service Account</span>
                                    <div class="row form-group mt-4">
                                          <div class="col-md-12 mb-3 mb-md-0">
                                                <label class="text-black" for="username">Username</label>
                                                <input type="text" name="username" id="username" class="form-control"
                                                      placeholder="username@12" required="">
                                          </div>
                                    </div>
                                    <div class="row form-group mt-4">
                                          <div class="col-md-12 mb-2">
                                                <label class="text-black" for="password">Password</label>
                                                <input type="password" name="password" id="password"
                                                      class="form-control" placeholder="Password" required="">
                                          </div>
                                    </div>

                                    <div class="row form-group mt-4 text-end">
                                          <div class="col-md-12">
                                                <input type="submit" name="login" value="Log In"
                                                      class="btn px-4 text-white">
                                                <?php
                  if(isset($_GET['msg']))
                  {
                    echo $_GET['msg'];
                  }
                 ?>
                                          </div>
                                    </div>

                              </form>
                        </div>

                  </div>
            </div>
      </section>

      <!-- form section end  -->


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