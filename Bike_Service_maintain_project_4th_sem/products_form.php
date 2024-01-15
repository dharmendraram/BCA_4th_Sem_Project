<?php
include './validation.php';
?>


<?php
require 'connection.php';

$id = $_GET['eid'];
$sql = "SELECT * FROM Products WHERE id = $id";
$product = $conn->query($sql);
$product = $product->fetch_assoc();

$category_sql= "SELECT * FROM Categories";
$category_result= $conn->query($category_sql);

if(isset($_POST['btnUpdateProduct']))
{
      if ($_FILES['image']['name']) {
            $target_dir = "uploads/";
            $epoch = microtime(true);
            $target_file = $target_dir .$epoch. basename($_FILES["image"]["name"]);
            $image_path = $target_dir.$epoch.htmlspecialchars(basename($_FILES["image"]["name"]));
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                die ("File is not an image.");
                $uploadOk = 0;
            }
        
            // Check if file already exists
            if (file_exists($target_file)) {
                die ("Sorry, file already exists.");
                $uploadOk = 0;
            }
        
            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                die ("Sorry, your file is too large.");
                $uploadOk = 0;
            }
        
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                die ("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                $uploadOk = 0;
            }
        
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                die ("Sorry, your file was not uploaded.");
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                } else {
                    die ("Sorry, there was an error uploading your file.");
                }
            }
      } else {
            $image_path = false;
      }
      $err=[];
      if (isset($_POST['pname']) && !empty($_POST['pname']))
      {
          $pname= $_POST['pname'];
          if (!preg_match ("/^[A-Za-z\- ]+(?: [A-Za-z\- ]+)?$/", $pname) )
          {
              $err['pname']="*Product name must be in strings";
          }
      }else{
          $err['pname']="*Enter product name"; 
      }
      if(count($err)==0)
      {
            $category=$_POST['category'];
            $image= $image_path ? $image_path : $product['image'];
            $quantity= $_POST['quantity'];
            $price= $_POST['price'];
            $description= $_POST['description'];
            $status= $_POST['status'];
        
        
        
            $sql = "UPDATE Products SET name='$pname', image='$image', quantity='$quantity', price='$price', category_id='$category', description='$description', status=$status WHERE id=$_GET[eid]";
        
            if($conn->query($sql))
            {
                echo '<script>alert("Product Updated.")</script>';
            }
            else{
                echo '<script>alert("Failed to update Product.")</script>';
            }

      }

}
    ?>



<?php include 'dashboard_top.php'; ?>
<div class="col-md-10" style="background:#f2f2f2; min-height:600px; border:1px solid #dddddd">
      <div class="row">
            <div class="col-12 py-3 bg-light">
                  <h5>Products</h5>
            </div>
      </div>

      <div class="row pt-3">
            <div class="col-md-8 offset-md-2">
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                              <label class="form-label">Category</label>
                              <select name="category" id="category" class="form-select">
                                    <option value="">Select Category</option>
                                    <?php
                    while($row=$category_result->fetch_assoc())
                    {
                    $selected = ($row['id'] == $product['category_id']) ? 'selected' : '';

                    echo '<option value=' . $row['id'] . ' ' . $selected . '>'.$row['category_name'].'</option>';
                    }
                    ?>
                              </select>
                        </div>


                        <div class="form-group mb-3">
                              <label class="form-label">Name</label>
                              <input type="text" name="pname" class="form-control"
                                    value="<?php echo $product['name']; ?>">
                        <br>
                    <h6 style="color:red">
                    <?php 
                if(isset($err['pname']))
                {
                    echo $err['pname'];
                }
                ?>
                              </h6>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Image</label>
                              <input type="file" name="image" class="form-control"
                                    value="<?php echo $product['image']; ?>">
                              <div>Uploaded Image: <img src="<?php echo $product['image']; ?>" style="height: 120px;width: 120px; object-fit: contain" alt=""> </div>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Quantity</label>
                              <input type="text" name="quantity" class="form-control"
                                    value="<?php echo $product['quantity']; ?>">
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Price</label>
                              <input type="text" name="price" class="form-control"
                                    value="<?php echo $product['price']; ?>">
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Description</label>
                              <input type="text" name="description" class="form-control"
                                    value="<?php echo $product['description']; ?>">
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Status</label>
                              <input type="radio" name="status" value="1" id="active"
                                    <?php if($product['status']==1) echo 'checked'; ?> />
                              <label for="active">Active</label>
                              <input type="radio" name="status" value="0" id="inactive"
                                    <?php if($product['status']==0) echo 'checked'; ?> />
                              <label for="inactive">Inactive</label>
                        </div>
                        <div class="form-group mb-4">
                              <input type="submit" name="btnUpdateProduct" class="btn btn-primary"
                                    value="Update Product" />
                        </div>
                  </form>
            </div>
      </div>
</div>

<?php include 'dashboard_bottom.php'; ?>
