<?php
include './validation.php';
?>

<?php
require 'connection.php';

$sql_select = "SELECT * FROM Orders";
$orders = $conn->query($sql_select);


if(isset($_GET['did']))
{
      $sql="DELETE FROM Orders WHERE id=$_GET[did]";
      if($conn->query($sql))
      {
            header('Location: orders.php');
      }
      else{
            die($conn->error);
      }
}
?>




<?php include 'dashboard_top.php'; ?>

<div class="col-md-10" style="background:#f2f2f2; min-height:600px; border:1px solid #dddddd">
    <div class="row">
        <div class="col-12 py-3 bg-light">
            <h5>Orders</h5>
        </div>
    </div>
                
    <div class="row bg-light mt-2">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>User_id</th>
                        <th>Product_id</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($row = $orders->fetch_assoc())
                        {
                            echo "<tr>
                            <td>$row[id]</td>
                            <td>$row[fname]</td>
                            <td>$row[mobile]</td>
                            <td>$row[email]</td>
                            <td>$row[address]</td>
                            <td>$row[user_id]</td>
                            <td>$row[product_id]</td>
                            <td>$row[payment]</td>
                            <td>$row[ostatus]</td>
                            <td><a href='order_form.php?aid=$row[id]' class='btn btn-success'>Accept</a></td>
                            <td><a href='orders.php?did=$row[id]' class='btn btn-danger' onclick='return confirm(`Are you sure?`)'>Delete</a></td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'dashboard_bottom.php'; ?>