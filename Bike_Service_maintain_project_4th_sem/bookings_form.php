<?php
include './validation.php';
?>


<?php
require 'connection.php';

$id = $_GET['eid'];
$sql = "SELECT * FROM Bookings WHERE id = $id";
$booking = $conn->query($sql);
$booking = $booking->fetch_assoc();

$services_sql= "SELECT * FROM Services";
$services_result= $conn->query($services_sql);

if(isset($_POST['btnUpdateBooking']))
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
        $service= $_POST['service'];
        $remarks= $_POST['remarks'];
    
        $sql = "UPDATE Bookings SET user_name='$uname', bike_name='$bname',bike_number='$bnumber', address='$address', time='$time', status='$status', service_id='$service' , remarks='$remarks' WHERE id=$id";
    
        if($conn->query($sql))
        {
            echo '<script>alert("Booking Updated.")</script>';
        }
        else{
            echo '<script>alert("Failed to update Booking.")</script>';
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

      <div class="row pt-3">
            <div class="col-md-8 offset-md-2">
                  <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                              <label class="form-label">Name</label>
                              <input type="text" name="uname" value="<?php echo $booking['user_name'] ?>"
                                    class="form-control">
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
                                    <?php while ($row = $services_result->fetch_assoc())  {
                            $selected = ($row['id'] == $booking['service_id']) ? 'selected' : '';

                            echo '<option value=' . $row['id'] . ' ' . $selected . '>' . $row['title'] . '</option>';
                            
                        } ?>
                              </select>
                        </div>

                        <div class="form-group mb-3">
                              <label class="form-label">Bike Name</label>
                              <input type="text" name="bname" class="form-control"
                                    value="<?php echo $booking['bike_name'] ?>">
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
                              <input type="text" name="bnumber" class="form-control"
                                    value="<?php echo $booking['bike_number'] ?>">
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
                              <input type="text" name="address" class="form-control"
                                    value="<?php echo $booking['address'] ?>">
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Time</label>
                              <input type="datetime-local" min="<?php echo date('Y-m-d\TH:i'); ?>" name="time"
                                    class="form-control" value="<?php echo $booking['time'] ?>"
                                    onkeyup="checkTime(this.value)">
                              <span class="text-danger" id="result"></span>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Remarks</label>
                              <input type="text" name="remarks" class="form-control"
                                    value="<?php echo $booking['remarks'] ?>">
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Status</label>
                              <input type="radio" name="status" value="1" id="active"
                                    <?php if($booking['status']==1) echo 'checked'; ?>>
                              <label for="active">Active</label>
                              <input type="radio" name="status" value="0" id="inactive"
                                    <?php if($booking['status']==0) echo 'checked'; ?>>
                              <label for="active">Inactive</label>
                        </div>
                        <div class="form-group mb-4">
                              <input type="submit" name="btnUpdateBooking" class="btn btn-primary"
                                    value="Update Booking" />
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