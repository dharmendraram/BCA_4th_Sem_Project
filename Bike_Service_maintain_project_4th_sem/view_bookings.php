<?php
require 'connection.php';

$id=$_GET['bookid'];

$sql_select = "SELECT * FROM Bookings 
JOIN Services
ON Bookings.service_id=Services.id
WHERE user_id=$id";
$bookings_details = $conn->query($sql_select);


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
          <h1 class="text-white font-weight-bold">Bookings</h1>
          <div class="custom-breadcrumbs">
            <a href="index.php" class="text-light fw-bold">Home</a><span class="mx-2 slash">/</span>
            <span class="text-white"><strong>Bookings</strong></span>
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
            <p class="fw-bold fs-4 pt-0">Booking Details</p>

            <div class="col-lg-12 mt-3 bg-secondary">
              <div class="row bg-light border rounded mt-2">
                <div class="col-12 fs-8 table-responsive">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Bike Name</th>
                              <th>Bike Number</th>
                              <th>Address</th>
                              <th>DateTime</th>
                              <th>Service Name</th>
                              <th>Remarks</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                              while($row = $bookings_details->fetch_assoc())
                              {
                                  echo "<tr>
                                  <td>$row[user_name]</td>
                                  <td>$row[bike_name]</td>
                                  <td>$row[bike_number]</td>
                                  <td>$row[address]</td>
                                  <td>$row[time]</td>
                                  <td>$row[title]</td>
                                  <td>$row[remarks]</td>
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