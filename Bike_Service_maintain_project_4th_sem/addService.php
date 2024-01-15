<?php
include './validation.php';
?>


<?php
require 'connection.php';


if(isset($_POST['btnAddService']))
{
    $count = 1;
    if (isset($_POST['title'])) {
        $slug = $_POST['title'];
        $query = "SELECT * FROM services WHERE title = '$slug'";

        $new = $conn->query($query);
        if ($new->num_rows > 0) {
            $count = 0;
            echo '<script>alert("Service has been already exist.")</script>';
        }
    }

    if (!$_FILES['image']['name']) {
        echo '<script>alert("Please choose the image.")</script>';
    } else {
        if ($count) {
            $target_dir = "uploads/";
            $epoch = microtime(true);
            $target_file = $target_dir . $epoch . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
            // Check if file already exists
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
                    // echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                } else {
                    die("Sorry, there was an error uploading your file.");
                }
            }
        
            $title=$_POST['title'];
            $price= $_POST['price'];
            $image=$target_file;
            $description= $_POST['description'];
        
            $sql = "INSERT INTO Services VALUES (null,'$title','$price','$image','$description')";
        
            if($conn->query($sql))
            {
                echo '<script>alert("Service Added.")</script>';
            }
            else{
                echo '<script>alert("Failed to add Service.")</script>';
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

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" min="1">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <div class="form-group">
                <input type="submit" name="btnAddService" class="btn btn-bg text-light" value="Add Service"/>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'dashboard_bottom.php'; ?>
