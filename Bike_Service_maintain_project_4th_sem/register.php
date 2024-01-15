<?php
require 'connection.php';
if(isset($_POST['register']))
{
  $err=[];
  //validation for Name
  if (isset($_POST['name']) && !empty($_POST['name']))
  {
    $name= $_POST['name'];
    if (!preg_match ("/^[A-Za-z\- ]+(?: [A-Za-z\- ]+)?$/", $name) )  //Dharmendra
    {
      $err['name']="*Name must be in letters";
    }
  }
  //validation for Address
  if (isset($_POST['address']) && !empty($_POST['address']))
  {
    $address= $_POST['address'];
    if (!preg_match ("/^[A-Za-z]+?$/", $address) )    //Balkumari
    {
      $err['address']="*Address must be in letters";
    }
  }
  //validation for Email
  if (isset($_POST['email']) && !empty($_POST['email']))
  {
    $email= trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) )
    {
      $err['email']="*Email must be in valid format";
    }
  }
//validation for Mobile number
  if (isset($_POST['mobile']) && !empty($_POST['mobile']))
  {
    $mobile=$_POST['mobile'];
    if (!preg_match ("/^[0-9]{10}+$/", $mobile))  //988366363
    {
      $err['mobile']="*Mobile number must be in 10 digits";
    }
  }
//validation for Username
  if (isset($_POST['username']) && !empty($_POST['username']))
  {
    $username=$_POST['username'];
    if (!preg_match ("/^[a-zA-Z]+@[0-9]+$/", $username)) //
    {
      $err['username']="*Username must be in admin@123 format";
    }
  }

  $count = 1;
    if (isset($_POST['email'])) {
        $slug = $_POST['email'];
        $query = "SELECT * FROM users WHERE email = '$slug'";

        $new = $conn->query($query);
        if ($new->num_rows > 0) {
            $count = 0;
            echo '<script>alert("Email has been already exist.")</script>';
        }
    }

    if(count($err)==0){
      if ($count) {
            $password= $_POST['password'];
            $cpassword= $_POST['cpassword'];
      
          $sql="INSERT INTO users VALUES (null,'$name','$mobile','$email','$address','$username',
                  '$password', 'user', 1)";
          if($password!== $cpassword)
          {
              header('Location: register.php?err=Password mismatch');
          } else {
            if(!$conn->query($sql)){
                die('Error:'.$conn->error);
            }
            echo '<script>alert("Registration Successful")</script>';
          }
      }
      
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
      <?php include 'head.php'; ?>
</head>

<body id="top">
      <?php include 'header.php'; ?>

      <!-- hero section start  -->
      <section class="inner-page" id="home-section">
            <div class="container">
                  <div class="row">
                        <div class="col-md-7 content">
                              <h1 class="text-white font-weight-bold">Register</h1>
                              <div class="custom-breadcrumbs">
                                    <a href="index.php" class="text-light fw-bold">Home</a><span
                                          class="mx-2 slash">/</span>
                                    <span class="text-white"><strong>Register</strong></span>
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
                                    <p class="fw-bold fs-4 pt-2">Registration</p>
                                    <span class="text-primary">Create a new Infnity Service Account</span>
                                    <div class="row form-group mt-3">
                                          <div class="col-md-12 mb-3 mb-md-0">
                                                <label class="text-black" for="fname">Full Name</label>
                                                <input type="text" name="name" id="fname" class="form-control"
                                                      placeholder="Enter your full name" required="">
                                          </div>
                                          <br>
                                          <h6 style="color:red">
                                                <?php 
                                           if(isset($err['name']))
                                              {
                                               echo $err['name'];
                                                  }
                                              ?>
                                          </h6>
                                    </div>
                                    <div class="row form-group mt-3">
                                          <div class="col-md-12 mb-3 mb-md-0">
                                                <label class="text-black" for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control"
                                                      placeholder="Enter address" required="">
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
                                                      placeholder="email@gmail.com" required="">
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
                                                <label class="text-black" for="number">Mobile No.</label>
                                                <input type="text" name="mobile" id="number" class="form-control"
                                                      placeholder="Enter mobile no." min="0" required="">
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
                                                <label class="text-black" for="username">Username</label>
                                                <input type="text" name="username" id="username" class="form-control"
                                                      placeholder="dharmu@12" min="0" required=""
                                                      onkeyup="checkUsername(this.value)">
                                                <span class="text-danger" id="result"></span>
                                          </div>
                                          <br>
                                          <h6 style="color:red">
                                                <?php 
                                           if(isset($err['username']))
                                              {
                                               echo $err['username'];
                                                  }
                                              ?>
                                          </h6>
                                    </div>
                                    <div class="row form-group mt-3">
                                          <div class="col-md-12 mb-3">
                                                <label class="text-black" for="password">Password</label>
                                                <input type="password" name="password" id="password"
                                                      class="form-control" minlength="6" placeholder="Password"
                                                      required="">
                                          </div>
                                    </div>
                                    <div class="row form-group mt-3">
                                          <div class="col-md-12 mb-3">
                                                <label class="text-black" for="cpassword">Confirm Password</label>
                                                <input type="password" name="cpassword" id="cpassword"
                                                      class="form-control" placeholder="Confirm Password" required="">
                                                <span class="text-danger"><?php if(isset($_GET['err'])) echo $_GET['err']; ?>
                                                </span>
                                          </div>
                                    </div>

                                    <div class="row form-group text-end">
                                          <div class="col-md-12">
                                                <input type="submit" name="register" value="Register"
                                                      class="btn px-4 text-white">
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
      function checkUsername(user) {
            console.log(user);
            let request = new XMLHttpRequest();
            request.open('GET', 'checkUsername.php?un=' + user);

            request.onreadystatechange = function() {
                  if (request.status == 200 && request.readyState == 4) {
                        document.getElementById("result").innerHTML = request.response;
                  }
            }
            request.send();
      }
      </script>



      <!-- Jquery cdn link  -->
      <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
      <!-- script file link  -->
      <script src="./js/main.js"></script>

      <!-- bootstrap js link  -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js
    "></script>
      <!-- owlcarosule js link  -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</body>

</html>