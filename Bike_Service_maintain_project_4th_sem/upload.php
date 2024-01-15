
<?php
require 'connection.php';

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST['submit']))
{
    $image=$_FILES["fileToUpload"]["name"];
  //  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    $sql="INSERT INTO files VALUES (null,'$image')";
    if($conn->query($sql)){
        echo "File Uploaded.";
    }else{
        echo "File is not uploaded.";
    }
}

