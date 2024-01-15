<?php
include './validation.php';
?>

<?php
require 'connection.php';

$id=$_GET['aid'];
$sql = "SELECT * FROM Orders WHERE id=$id";
$orders = $conn->query($sql);
$orders=$orders->fetch_assoc();

if(isset($_POST['btnAccept']))
{
  $uname=$_POST['uname'];
  $mobile=$_POST['mobile'];
  $address= $_POST['address'];
  $email= $_POST['email'];
  $status= $_POST['status'];


  $sql = "UPDATE Orders SET fname='$uname', mobile='$mobile', address='$address', email='$email', ostatus='$status' WHERE id=$id ";

  if($conn->query($sql))
  {
    header ('Location:orders.php');
  }
  else{
    echo '<script>alert("'. $conn->error .'")</script>';
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

      <div class="row pt-3">
            <div class="col-md-8 offset-md-2">
                  <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                              <label class="form-label">Full Name</label>
                              <input type="text" name="uname" value="<?php echo $orders['fname']; ?>"
                                    class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Mobile Number</label>
                              <input type="text" name="mobile" value="<?php echo $orders['mobile']; ?>"
                                    class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Address</label>
                              <input type="text" name="address" value="<?php echo $orders['address']; ?>"
                                    class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Email Address</label>
                              <input type="email" name="email" value="<?php echo $orders['email'] ;?>"
                                    class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Status</label>
                              <input type="radio" name="status" value="pending" id="pending"
                                    <?php if($orders['ostatus']=='pending') echo 'checked'; ?>>
                              <label for="pending">Pending</label>
                              <input type="radio" name="status" value="accepted" id="accepted"
                                    <?php if($orders['ostatus']=='accepted') echo 'checked'; ?>>
                              <label for="accepted">Accept</label>
                              <input type="radio" name="status" value="delivered" id="delivered"
                                    <?php if($orders['ostatus']=='delivered') echo 'checked'; ?>>
                              <label for="delivered">Delivered</label>
                        </div>
                        <div class="form-group">
                              <input type="submit" name="btnAccept" class="btn btn-primary" value="Accept" />
                        </div>
                  </form>
            </div>
      </div>
</div>
<?php include 'dashboard_bottom.php'; ?>