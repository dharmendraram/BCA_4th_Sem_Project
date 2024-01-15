<?php
session_start();
// echo $_SESSION['usertype'];
if(!isset($_SESSION['username']))
{
    header('Locaton: login.php');
} elseif ($_SESSION['usertype'] != 'admin') {
    header('Location: index.php');
}
?>