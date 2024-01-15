<?php
include './validation.php';
?>


<?php
require 'connection.php';

$services_sql= "SELECT * FROM Services";
$services_result= $conn->query($services_sql);

if(isset($_POST['btnAddBooking']))
{   
    $err=[];
    if (isset($_POST['uname']) && !empty($_POST['uname']))
    {
        $uname= $_POST['uname'];
        if (!preg_match ("/^[A-Za-z\- ]+(?: [A-Za-z\- ]+)?$/", $uname) )
        {
            $err['uname']="*Name must be in strings";
        }
    }
    if (isset($_POST['bname']) && !empty($_POST['bname']))
    {
        $bname= $_POST['bname'];
        if (!preg_match ("/^[A-Za-z\- ]+([0-9\- ]+)?$/", $bname) )
        {
            $err['bname']="*Bike name must start with strings";
        }
    }
    if (isset($_POST['bnumber']) && !empty($_POST['bnumber']))
    {
        $bnumber= $_POST['bnumber'];
        if (!preg_match ("/^[A-Za-z0-9\- ]+[0-9\- ]+[0-9\- ]$/", $bnumber) )
        {
            $err['bnumber']="*Bike number must start with strings";
        }
    }
    if(count($err)==0)
    {
        $address= $_POST['address'];
        $time= $_POST['time'];
        $status= $_POST['status'];
        $user_id=$_SESSION['userid'];
        $service= $_POST['service'];
        $remarks= $_POST['remarks'];
    
        $sql = "INSERT INTO Bookings VALUES (null,'$uname','$bname','$bnumber','$address','$time', '$status' ,'$user_id','$service', '$remarks')";
        if($conn->query($sql))
        {
            echo '<script>alert("Booking Added.")</script>';
        }
        else{
            echo '<script>alert("Failed to add Booking.")</script>';
        }
    }
}
?>

<?php include 'dashboard_top.php'; ?>

<div class="col-md-10" style="background:#f2f2f2; min-height:600px; border:1px solid #dddddd">
      <div class="row">
            <div class="col-12 py-3 bg-light">
                  <h5>Bookings</h5>
            </div>
      </div>
      <div class="row">
            <div class="col-md-8 offset-md-2">
                  <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                              <label class="form-label">Name</label>
                              <input type="text" name="uname" class="form-control">
                              <br>
                              <h6 style="color:red">
                                    <?php 
                                    if(isset($err['uname']))
                                    {
                                        echo $err['uname'];
                                    }
                                    ?>
                              </h6>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Service</label>
                              <select name="service" id="" class="form-select">
                                    <option value="">Select Service</option>
                                    <?php
                                    while($row= $services_result->fetch_assoc())
                                    {
                                        echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                                    }
                                    ?>
                              </select>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Bike Name</label>
                              <input type="text" name="bname" class="form-control">
                              <br>
                              <h6 style="color:red">
                                    <?php 
                    if(isset($err['bname']))
                    {
                        echo $err['bname'];
                    }
                    ?>
                              </h6>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Bike Number</label>
                              <input type="text" name="bnumber" class="form-control">
                              <br>
                              <h6 style="color:red">
                                    <?php 
                    if(isset($err['bnumber']))
                    {
                        echo $err['bnumber'];
                    }
                    ?>
                              </h6>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Address</label>
                              <input type="text" name="address" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Time</label>
                              <input type="datetime-local" min="<?php echo date('Y-m-d\TH:i'); ?>" name="time"
                                    class="form-control" onkeyup="checkTime(this.value)">
                              <span class="text-danger" id="result"></span>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Remarks</label>
                              <input type="text" name="remarks" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Status</label>
                              <input type="radio" name="status" value="1" id="active">
                              <label for="active">Active</label>
                              <input type="radio" name="status" value="0" id="inactive">
                              <label for="active">Inactive</label>
                        </div>
                        <div class="form-group mb-4">
                              <input type="submit" name="btnAddBooking" class="btn btn-bg text-light"
                                    value="Add Booking" />
                        </div>
                  </form>
            </div>
      </div>
</div>

<?php include 'dashboard_bottom.php'; ?>

<script>
function checkTime(time) {
      console.log(time);
      let request = new XMLHttpRequest();
      request.open('GET', 'checkTime.php?ti=' + time);

      request.onreadystatechange = function() {
            if (request.status == 200 && request.readyState == 4) {
                  document.getElementById("result").innerHTML = request.response;
            }
      }
      request.send();
}
</script>