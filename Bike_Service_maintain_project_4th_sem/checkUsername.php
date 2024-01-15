<?php
require 'connection.php';
$sql_checkUser= "SELECT * FROM users WHERE username='$_GET[un]'";
    $result_checkUser= $conn->query($sql_checkUser);
    if($result_checkUser->num_rows>0)
    {
        echo 'Username already exists.';
    }
    else{
      echo '<span style="color:green">Valid Username</span>';
    }
    ?>