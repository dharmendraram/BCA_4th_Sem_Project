<?php
require 'connection.php';

session_start();

if (!isset($_SESSION['userid'])) {
  header('Location: login.php');
}

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
      $err['uname']="*Name must be in letters";
    }
  }
  if (isset($_POST['bname']) && !empty($_POST['bname']))
  {
    $bname= $_POST['bname'];
    if (!preg_match ("/^[A-Za-z\- ]+([0-9\- ]+)?$/", $bname) )
    {
      $err['bname']="*Bike name must start with letters";
    }
    }
  if (isset($_POST['bnumber']) && !empty($_POST['bnumber']))
  {
    $bnumber= $_POST['bnumber'];
    if (!preg_match ("/^[A-Za-z0-9\- ]+[0-9\- ]+[0-9\- ]$/", $bnumber) )
    {
      $err['bnumber']="*Bike number must start with letters";
    }
  }

  if (isset($_POST['address']) && !empty($_POST['address']))
  {
    $address= $_POST['address'];
    if (!preg_match ("/^[A-Za-z]+?$/", $address) )    //Balkumari
    {
      $err['address']="*Address must be in letters";
    }
  }

  if(count($err)==0)
  {
    $time= $_POST['time'];
    $status= '1';
    $user=$_SESSION['userid'];
    $service= $_POST['service'];
    $remarks= $_POST['remarks'];

    $sql = "INSERT INTO Bookings VALUES (null,'$uname','$bname','$bnumber','$address','$time', '$status  ' , '$user' , '$service', '$remarks')";

    if($conn->query($sql))
    {
      echo '<script>alert("Booking Added.")</script>';
    }
    else{
      echo '<script>alert("Please register or login.")</script>';
    }
  }
}

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
    <!-- hero section start  -->
  <section class="inner-page" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-7 content">
          <h1 class="text-white font-weight-bold">Booking</h1>
          <div class="custom-breadcrumbs">
            <a href="index.php" class="text-light fw-bold">Home</a><span class="mx-2 slash">/</span>
            <a href="view_bookings.php?bookid='<?php if(isset($_SESSION['userid'])){
              echo $_SESSION['userid'];
            }
            ?>'"><span class="text-white"><strong>Booking</strong></span></a>
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
          <form action="#" method="POST" class="p-5 shadow rounded-4">
            <p class="fw-bold fs-4 pt-2">Booking</p>
            <span class="text-primary">Infinity Service</span>
            <div class="row form-group mt-3">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="uname">Full Name</label>
                  <input type="text" name="uname" id="uname" class="form-control" placeholder="Dharmendra Kumar ram" required="">
                </div>
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
              <div class="row form-group mt-3">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="service">Service</label>
                  <select name="service" id="service" class="form-select">
                  <option value="">Select Service</option>
                    <?php
                    while($row= $services_result->fetch_assoc())
                    {
                        echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                    }
                    ?>
                </select>
                </div>
              </div>
              <div class="row form-group mt-3">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="bname">Bike Name</label>
                  <input type="text" name="bname" id="bname" class="form-control" placeholder="Fz-s" required="">
                </div>
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
              <div class="row form-group mt-3">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="bnumber">Bike Number</label>
                  <input type="text" name="bnumber" id="bnumber" class="form-control" placeholder="pa-03-002-5678" required="">
                </div>
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
              <div class="row form-group mt-3">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="address">Address</label>
                  <input type="text" name="address" id="address" class="form-control" placeholder="Address" required="">
                </div>
                <br>
                <h6 style="color:red">
                <?php
                  if(isset($err['address']))
                  {
                    echo $err['address'];
                  }
                ?>
                </h6>
              </div>
            <div class="row form-group mt-3">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="time">Time</label>
                <input type="datetime-local" min="<?php echo date('Y-m-d\TH:i'); ?>" name="time" id="time" class="form-control" placeholder="1-2" required="" onkeyup="checkTime(this.value)">
                <span class="text-danger" id="result"></span>
              </div>
            </div>
            <div class="row form-group mt-3">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="remarks">Remarks</label>
                <input type="text" name="remarks" id="remarks" class="form-control" placeholder="For any help" required="">
              </div>
            </div>

            <div class="row form-group mt-5 text-end">
              <div class="col-md-12">
                <input type="submit" name="btnAddBooking" value="Add Booking" class="btn px-4 btn-bg text-white">
              </div>
            </div>

          </form>
        </div>

      </div>
    </div>
  </section>

<!-- form section end  -->

    <?php include 'footer.php'; ?>

    <script>
function checkTime(time)
{
    console.log(time);
    let request= new XMLHttpRequest();
    request.open('GET', 'checkTime.php?ti='+time);

    request.onreadystatechange= function(){
        if(request.status == 200 && request.readyState == 4)
        {
            document.getElementById("result").innerHTML=request.response;
        }
    }
    request.send();
}
</script>




  </body>
</html>
