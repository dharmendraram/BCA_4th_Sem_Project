<?php
include './validation.php';
?>

<?php
require "connection.php";

$categories="SELECT COUNT(*) AS total FROM Categories";
$result_categories=$conn->query($categories);

$products="SELECT COUNT(*) AS total_product FROM Products";
$result_products=$conn->query($products);

$users="SELECT COUNT(*) AS total_user FROM users";
$result_users=$conn->query($users);

$orders="SELECT COUNT(*) AS total_order FROM Orders";
$result_orders=$conn->query($orders);

$services="SELECT COUNT(*) AS total_service FROM Services";
$result_services=$conn->query($services);

$bookings="SELECT COUNT(*) AS total_booking FROM Bookings";
$result_bookings=$conn->query($bookings);
?>

<?php include 'dashboard_top.php'; ?>

<div class="col-md-10 bg-light" style="border:1px solid #dddddd">
      <div class="row">
            <div class="col-12 bg-light py-3 ">
                  <h5>Dashboard</h5>
            </div>
      </div>
      <div class="row g-4">
            <div class="col-md-4">
                  <div style="background-color: #e1e1e1"
                        class="border px-4 py-5 rounded d-flex justify-content-between">
                        <h2 style="font-size: 24px;"><i class="bi bi-grid "
                                    style="font-size: 52px;padding-bottom: 30px;color: green;"></i> <br> <br> Total
                              Category
                        </h2>
                        <h4 class="" style="font-weight: 400 !important;text-align: end;font-size: xxx-large;">
                              <?php
                        $row=$result_categories->fetch_assoc();
                        echo $row['total'];
                    ?>
                        </h4>
                  </div>
            </div>
            <div class="col-md-4">
                  <div style="background-color: #e1e1e1"
                        class="border px-4 py-5 rounded d-flex justify-content-between">
                        <h2 style="font-size: 24px;"><i class="bi bi-basket"
                                    style="font-size: 52px;padding-bottom: 30px;color: green;"></i> <br> <br> Total
                              Product
                        </h2>
                        <h4 class="" style="font-weight: 400 !important;text-align: end;font-size: xxx-large;">
                              <?php
                        $row=$result_products->fetch_assoc();
                        echo $row['total_product'];
                    ?>
                        </h4>
                  </div>
            </div>
            <div class="col-md-4">
                  <div style="background-color: #e1e1e1"
                        class="border px-4 py-5 rounded d-flex justify-content-between">
                        <h2 style="font-size: 24px;"><i class="bi bi-people"
                                    style="font-size: 52px;padding-bottom: 30px;color: green;"></i> <br> <br> Total User
                        </h2>
                        <h4 class="" style="font-weight: 400 !important;text-align: end;font-size: xxx-large;">
                              <?php
                        $row=$result_users->fetch_assoc();
                        echo $row['total_user'];
                    ?>
                        </h4>
                  </div>
            </div>
            <div class="col-md-4">
                  <div style="background-color: #e1e1e1"
                        class="border px-4 py-5 rounded d-flex justify-content-between">
                        <h2 style="font-size: 24px;"><i class="bi bi-basket-fill"
                                    style="font-size: 52px;padding-bottom: 30px;color: green;"></i> <br> <br> Total
                              Orders
                        </h2>
                        <h4 class="" style="font-weight: 400 !important;text-align: end;font-size: xxx-large;">
                              <?php
                        $row=$result_orders->fetch_assoc();
                        echo $row['total_order'];
                    ?>
                        </h4>
                  </div>
            </div>
            <div class="col-md-4">
                  <div style="background-color: #e1e1e1"
                        class="border px-4 py-5 rounded d-flex justify-content-between">
                        <h2 style="font-size: 24px;"><i class="bi bi-shop"
                                    style="font-size: 52px;padding-bottom: 30px;color: green;"></i> <br> <br> Total
                              Services
                        </h2>
                        <h4 class="" style="font-weight: 400 !important;text-align: end;font-size: xxx-large;">
                              <?php
                        $row=$result_services->fetch_assoc();
                        echo $row['total_service'];
                    ?>
                        </h4>
                  </div>
            </div>
            <div class="col-md-4">
                  <div style="background-color: #e1e1e1"
                        class="border px-4 py-5 rounded d-flex justify-content-between">
                        <h2 style="font-size: 24px;"><i class="bi bi-briefcase-fill"
                                    style="font-size: 52px;padding-bottom: 30px;color: green;"></i> <br> <br> Total
                              Bookings
                        </h2>
                        <h4 class="" style="font-weight: 400 !important;text-align: end;font-size: xxx-large;">
                              <?php
                        $row=$result_bookings->fetch_assoc();
                        echo $row['total_booking'];
                    ?>
                        </h4>
                  </div>
            </div>
      </div>
</div>

<?php include 'dashboard_bottom.php'; ?>
</body>

</html>