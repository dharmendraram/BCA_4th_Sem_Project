<?php
include './validation.php';
?>


<?php
require 'connection.php';

$id = $_GET['eid'];
$sql = "SELECT * FROM Services WHERE id = $id";
$service = $conn->query($sql);
$service = $service->fetch_assoc();

if(isset($_POST['btnUpdateService']))
{
      $count = 1;
      if (isset($_POST['title'])) {
            $slug = $_POST['title'];
            $id = $_GET['eid'];
            $query = "SELECT * FROM services WHERE `id` != $id AND title = '$slug'";

            $new = $conn->query($query);
            if ($new->num_rows > 0) {
                  $count = 0;
                  echo '<script>alert("Service has been already exist.")</script>';
            }
      }

      if ($_FILES['image']['name']) {
            $target_dir = "uploads/";
            $epoch = microtime(true);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        
            // Check if file already exists
            $target_file = $target_dir . $epoch . "." . $imageFileType;
        
            $fileName = $_FILES["image"]["name"];
            if (file_exists($target_file)) {
                die("Sorry, file already exists.");
                $uploadOk = 0;
            }
        
            // Check file size (you can adjust the size limit as needed)
            if ($_FILES["image"]["size"] > 500000) {
                die("Sorry, your file is too large.");
                $uploadOk = 0;
            }
        
            // Allow SVG files
            if ($imageFileType != "svg" && $imageFileType != "jpeg" && $imageFileType != "jpg" && $imageFileType != "png") {
                die("Sorry,  SVG or images files are allowed.");
                $uploadOk = 0;
            }
        
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                die("Sorry, your file was not uploaded.");
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                  //   echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                } else {
                    die("Sorry, there was an error uploading your file.");
                }
            }
      } else {
            $target_file = false;
      }
      $err=[];
      if (isset($_POST['title']) && !empty($_POST['title']))
      {
            $title= $_POST['title'];
              if (!preg_match ("/^[A-Za-z\- ]+(?: [A-Za-z\- ]+)?$/", $title) )
              {
                  $err['title']="*Service name must be in strings";
              }
      }
      else{
        $err['title']="*Enter service name"; 
    }
    if(count($err)==0)
    {
      if ($count) {
            $price= $_POST['price'];
          $description= $_POST['description'];
            $image = $target_file ? $target_file : $service['image'];
      
          $sql = "UPDATE Services SET title='$title', price='$price', image='$image', description='$description' WHERE id=$_GET[eid]";
      
          if($conn->query($sql))
          {
              echo '<script>alert("Service Updated.")</script>';
          }
          else{
              echo '<script>alert("Failed to update Service.")</script>';
          }
      }
          
    }
}
?>


<?php include 'dashboard_top.php'; ?>

<div class="col-md-10" style="background:#f2f2f2; min-height:600px; border:1px solid #dddddd">
      <div class="row">
            <div class="col-12 py-3 bg-light">
                  <h5>Services</h5>
            </div>
      </div>

      <div class="row pt-3">
            <div class="col-md-8 offset-md-2">
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                              <label class="form-label">Title</label>
                              <input type="text" name="title" class="form-control"
                                    value="<?php echo $service['title']; ?>">
                                    <br>
                    <h6 style="color:red">
                    <?php 
                if(isset($err['title']))
                {
                    echo $err['title'];
                }
                ?>
                              </h6>
                        </div>

                        <div class="form-group mb-3">
                              <label class="form-label">Price</label>
                              <input type="text" name="price" class="form-control"
                                    value="<?php echo $service['price']; ?>">
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Image</label>
                              <input type="file" name="image" class="form-control"
                                    value="<?php echo $service['image']; ?>">
                              <div>Uploaded Image: <img src="<?php echo $service['image']; ?>" style="height: 120px;width: 120px; object-fit: contain" alt=""> </div>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Description</label>
                              <input type="text" name="description" class="form-control"
                                    value="<?php echo $service['description']; ?>">
                        </div>
                        <div class="form-group">
                              <input type="submit" name="btnUpdateService" class="btn btn-primary"
                                    value="Update Service" />
                        </div>
                  </form>
            </div>
      </div>
</div>

<?php include 'dashboard_bottom.php'; ?>
