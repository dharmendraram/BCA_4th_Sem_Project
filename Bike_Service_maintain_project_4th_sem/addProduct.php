<?php
include './validation.php';
?>

<?php
require 'connection.php';

$category_sql= "SELECT * FROM Categories";
$category_result= $conn->query($category_sql);

if(isset($_POST['btnAddProduct']))
{
    if (!$_FILES['image']['name']) {
        echo '<script>alert("Please choose the image.")</script>';
    } else {
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
                //
            } else {
                die ("Sorry, there was an error uploading your file.");
            }
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
            $image=$image_path;
            $quantity= $_POST['quantity'];
            $price= $_POST['price'];
            $description= $_POST['description'];
            $status= $_POST['status'];
        
            $sql = "INSERT INTO Products VALUES (null,'$pname','$image','$quantity','$price','$category','$description','$status')";
        
            if($conn->query($sql))
            {
                echo '<script>alert("Product Added.")</script>';
            }
            else{
                echo '<script>alert("Failed to add Product.")</script>';
            }
    
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
    <div class="row mt-3">
        <div class="col-md-8 offset-md-2">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" id="category" class="form-select">
                    <option value="">Select Category</option>
                    <?php
                    while($row=$category_result->fetch_assoc())
                    {
                        echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>';
                    }
                    ?>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="pname" class="form-control">
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
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" min="1">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" min="1">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Status</label>
                    <input type="radio" name="status" value="1" id="active"/>
                    <label for="active">Active</label>
                    <input type="radio" name="status" value="0" id="inactive"/>
                    <label for="inactive">Inactive</label>
                </div>
                <div class="form-group mb-4">
                <input type="submit" name="btnAddProduct" class="btn btn-bg text-light" value="Add Product"/>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'dashboard_bottom.php'; ?>
