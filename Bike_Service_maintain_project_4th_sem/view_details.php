<?php
require 'connection.php';

$id=$_GET['deid'];

$sql_select = "SELECT * FROM Orders 
JOIN Products
ON Orders.product_id=Products.id
WHERE user_id=$id";
$orders_details = $conn->query($sql_select);


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
  <?php if (!isset($_SESSION['userid'])) {
            header('Location: login.php');
          } ?>

    <!-- hero section start  -->
  <section class="inner-page" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-7 content">
          <h1 class="text-white font-weight-bold">Order</h1>
          <div class="custom-breadcrumbs">
            <a href="index.php" class="text-light fw-bold">Home</a><span class="mx-2 slash">/</span>
            <span class="text-white"><strong>Order</strong></span>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- hero section end  -->


<section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 my-5">
          <div class="p-5 shadow rounded-4">
            <p class="fw-bold fs-4 pt-0">Order Details</p>

            <div class="col-lg-12 mt-3 bg-secondary">
              <div class="row bg-light border rounded mt-2">
                <div class="col-12 fs-8 table-responsive">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Address</th>
                              <th>Product Name</th>
                              <!-- <th>Payment</th> -->
                              <th>Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                              while($row = $orders_details->fetch_assoc())
                              {
                                  echo "<tr>
                                  <td>$row[fname]</td>
                                  <td>$row[mobile]</td>
                                  <td>$row[email]</td>
                                  <td>$row[address]</td>
                                  <td>$row[name]</td>
                                
                                  <td>$row[ostatus]</td>
                                  </tr>";
                              }
                          ?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    
      </div>
    </div>
</section>




<!-- form section end  -->

    <?php include 'footer.php'; ?>



    
</body>
</html>