<?php
session_start();
?>

    <!-- header section start -->
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container py-1">
          <a class="navbar-brand" href="index.php">
            <img src="./img/logo.png" alt="Logo"  height="30">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1">

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="view_details.php?deid='<?php if(isset($_SESSION['userid'])){
                  echo $_SESSION['userid'];
                }
                ?>'">My Orders</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="view_bookings.php?bookid='<?php if(isset($_SESSION['userid'])){
                  echo $_SESSION['userid'];
                }
                ?>'">My Bookings</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="product_front.php">Products</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="booking_form.php">Service & Maintenance</a>
              </li>

              <li class="nav-item dropdown ps-2">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
                <?php if(isset($_SESSION['username'])){
                  echo $_SESSION['username'];
                }
                ?>
                </a>
                <ul class="dropdown-menu">
                <?php if(isset($_SESSION['username'])){
                 echo '<li><a class="dropdown-item" href="./logout.php">Log out</a></li>';

                }
                ?>
                </ul>
              </li>
            </ul>
            <form action="">
            <?php if(!isset($_SESSION['username'])){
             echo' <a href="register.php" class="p-2 btn-bg mx-2 rounded text-light">Register</a>
              <a href="login.php" class="py-2 px-3 btn-bg rounded text-light">Login</a>';
            }
            ?>
            </form>

          </div>
        </div>
      </nav>
          </header>
      <!-- header section end -->
