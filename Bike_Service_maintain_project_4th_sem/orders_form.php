<?php 
      require 'connection.php';
      include 'header.php';
      
      if (!isset($_SESSION['userid'])) {
            header('Location: login.php');
          }

      // session_start();

      $productId = $_GET['oid'];

      $sql="SELECT name FROM Products WHERE id= $productId";
      $product=$conn->query($sql);
      $product = $product->fetch_assoc();

if(isset($_POST['btnBuyNow']))
{
  $err=[];
  //validation for Name
        if (isset($_POST['uname']) && !empty($_POST['uname']))
        {
          $uname= $_POST['uname'];
          if (!preg_match ("/^[A-Za-z\- ]+(?: [A-Za-z\- ]+)?$/", $uname) )  //Dharmendra
          {
            $err['uname']="*Name must be in letters";
          }
        }else{
          $err['uname']="Enter your name";
        }
  
  //validation for mobile number
        if (isset($_POST['mobile']) && !empty($_POST['mobile']))
        {
          $mobile=$_POST['mobile'];
          if (!preg_match ("/^[0-9]{10}+$/", $mobile))  //988366363
          {
            $err['mobile']="*Mobile number must be in 10 digits";
          }
        }else{
          $err['mobile']="Enter your Mobile Number";
        }
  //validation for Address
        if (isset($_POST['address']) && !empty($_POST['address']))
        {
          $address= $_POST['address'];
          if (!preg_match ("/^[A-Za-z]+?$/", $address) )    //Balkumari
          {
            $err['address']="*Address must be in letters";
          }
        }else{
          $err['address']="Enter your Address";
        }
   //validation for Email
        if (isset($_POST['email']) && !empty($_POST['email']))
        {
          $email= trim($_POST['email']);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL) )
          {
            $err['email']="*Email must be in valid format";
          }
        }else{
          $err['email']="Enter your Email";
        }

   
   if(count($err)==0){
                        $userid= $_SESSION['userid'];
                        $payment= $_POST['payment'];
                        $status= 'pending';

                        $sql = "INSERT INTO Orders VALUES (null,'$uname','$mobile','$address','$email', '$userid' ,'$productId', '$payment','$status')";

                        if($conn->query($sql))
                        {
                          echo '<script>alert("Requested")</script>';
                        }
                        else{
                          echo '<script>alert("'. $conn->error .'")</script>';
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
      
      <!-- hero section start  -->
      <section class="inner-page" id="home-section">
            <div class="container">
                  <div class="row">
                        <div class="col-md-7 content">
                              <h1 class="text-white font-weight-bold">Order</h1>
                              <div class="custom-breadcrumbs">
                                    <a href="index.php" class="text-light fw-bold">Home</a><span
                                          class="mx-2 slash">/</span>
                                    <a href="view_details.php?deid='<?php echo (isset($_SESSION['userid'])); ?>'"><span
                                                class="text-white"><strong>Order</strong></span></a>
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
                                    <p class="fw-bold fs-4 pt-2">Order</p>
                                    <span class="text-primary">Infinity Service...</span>
                                    <div class="row form-group mt-3">
                                          <div class="col-md-12 mb-3 mb-md-0">
                                                <label class="text-black" for="uname">Full Name</label>
                                                <input type="text" name="uname" id="uname" class="form-control"
                                                      placeholder="Dharmendra Kumar ram">
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
                                                <label class="text-black" for="mobile">Mobile Number</label>
                                                <input type="text" name="mobile" id="mobile" class="form-control">
                                          </div>
                                          <br>
                                          <h6 style="color:red">
                                                <?php 
                                           if(isset($err['mobile']))
                                              {
                                               echo $err['mobile'];
                                                  }
                                              ?>
                                          </h6>
                                    </div>
                                    <div class="row form-group mt-3">
                                          <div class="col-md-12 mb-3 mb-md-0">
                                                <label class="text-black" for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control"
                                                      placeholder="Address">
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
                                                <label class="text-black" for="email">Email Address</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                      placeholder="email@gmail.com">
                                          </div>
                                          <br>
                                          <h6 style="color:red">
                                                <?php 
                                           if(isset($err['email']))
                                              {
                                               echo $err['email'];
                                                  }
                                              ?>
                                          </h6>
                                    </div>
                                    <div class="row form-group mt-3">
                                          <div class="col-md-12 mb-3 mb-md-0">
                                                <label class="text-black" for="uid">User Name</label>
                                                <input type="text" name="uid" id="uid" class="form-control"
                                                      value="<?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?>"
                                                      placeholder="*must logged in to order" readonly>
                                          </div>
                                    </div>
                                    <div class="row form-group mt-3">
                                          <div class="col-md-12 mb-3 mb-md-0">
                                                <label class="text-black" for="pid">Product Name</label>
                                                <input type="text" name="pid" id="pid" class="form-control"
                                                      value="<?php echo $product['name']; ?>" readonly>
                                          </div>
                                    </div>
                                    <div class="row form-group mt-3">
                                          <div class="col-md-12 mb-3 mb-md-0">
                                                <label class="text-black" for="payment">Payment</label>
                                                <input type="text" name="payment" id="payment" class="form-control"
                                                      placeholder="Cash on delivery.." readonly>
                                          </div>
                                    </div>

                                    <div class="row form-group mt-5 text-end">
                                          <div class="col-md-12">
                                                <input type="submit" name="btnBuyNow" value="Buy Now"
                                                      class="btn px-4 btn-primary text-white">
                                          </div>
                                    </div>

                              </form>
                        </div>

                  </div>
            </div>
      </section>

      <!-- form section end  -->

      <?php include 'footer.php'; ?>




</body>

</html>