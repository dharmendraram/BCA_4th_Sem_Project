<?php
require 'connection.php';
$dateInput = substr($_GET['ti'], 0, 10);

$sql_checkTime= "SELECT * FROM Bookings WHERE DATE(time)='$dateInput'";

    $result_checkTime= $conn->query($sql_checkTime);

    $count = 0;
    while ($row = $result_checkTime->fetch_assoc()) {
    $newDateTime = date('Y-m-d\TH:i', strtotime($row['time'] . ' +30 minutes'));
    
    // echo '<br />';
    // echo 'Original Time: ' . $row['time'] . '<br />';
    // echo 'New Time: ' . $newDateTime . '<br />';

    if (($_GET['ti'] >= $row['time']) && ($_GET['ti'] <= $newDateTime)) {
        $count = 1;
        break;
    } 
}
    if($count == 1) 
    {
        echo 'Time already booked.';
    }
    else{
      echo '<span style="color:green">Time available.</span>';
    }
    ?>