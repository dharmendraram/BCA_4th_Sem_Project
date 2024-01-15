<?php
require 'connection.php';//action for new folder if incase connection is in new folder
session_start();

$msg="";

if(isset($_POST['login']))
{
    $username= $_POST['username'];
    $password= $_POST['password'];
    $sql ="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $user = $conn->query($sql);
    if($user-> num_rows > 0)
    {
        $user= $user->fetch_assoc();
        //print_r($user); raw data  
        $_SESSION['userid']= $user['id'];
        $_SESSION['username']= $user['username'];
        $_SESSION['usertype']= $user['type'];
        if($user['type']=='admin')
        {
            header('Location: dashboard.php');
        }
        else {
            header('Location: index.php');
        }
         
        //$msg="Logged in";
       // $msg='<label for="" class="text-success">Logged in</label>';
    }
    else {
        //$msg="Username/Password does not match.";
        $msg='<label for="" class="text-danger">wrong credential.</label>';
        header('location: login.php?msg='. $msg);
        
    }
}
?>