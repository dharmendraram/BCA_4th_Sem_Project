<?php
include './validation.php';
?>


<?php
require 'connection.php';


if(isset($_GET['did']))
    {
        $sql_delete = "DELETE FROM Bookings WHERE id = $_GET[did]";
        if($conn->query($sql_delete)){
            header('Location: bookings.php?msg=Booking Deleted');
        }
        else{
            die($conn->error);
        }
    }
    if(isset($_GET['msg']))
    {
        echo'<script>alert("'.$_GET['msg'].'")</script>';
    }

    $booking_sql = "SELECT * FROM Bookings ";
    $result_booking = $conn->query($booking_sql);
    ?>


<?php include 'dashboard_top.php'; ?>

<div class="col-md-10" style="background:#f2f2f2; min-height:600px; border:1px solid #dddddd">
    <div class="row">
        <div class="col-12 bg-light py-3 d-flex align-items-center justify-content-between">
            <h5>Bookings</h5>

            <!-- <div>
                <h5 class="mb-0 fs-6">
                <a href="addBooking.php" class="text-white btn-bg p-2 rounded">
                <i class="bi bi-plus-lg"></i> Add Bookings</a>
                </h5>
            </div> -->
        </div>
    </div>    

    <div class="row bg-light mt-2">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>User Name</th>
                        <th>UserId</th>
                        <th>Service_id</th>
                        <th>Bike Name</th>
                        <th>Bike Number</th>
                        <th>Address</th>
                        <th>Time</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $Status=[0=>'Inactive', 1=>'Active'];
                        while($row = $result_booking->fetch_assoc())
                        {
                            echo "<tr>
                            <td>$row[id]</td>
                            <td>$row[user_name]</td>
                            <td>$row[user_id]</td>
                            <td>$row[service_id]</td>
                            <td>$row[bike_name]</td>
                            <td>$row[bike_number]</td>
                            <td>$row[address]</td>
                            <td>$row[time]</td>
                            <td>$row[remarks]</td>
                            <td>" . $Status[$row['status']] ." </td>
                            <td><a href='bookings_form.php?eid=$row[id]' class='btn btn-info'>Edit</a></td>
                            <td><a href='bookings.php?did=$row[id]' class='btn btn-danger' onclick='return confirm(`Are you sure?`)'>Delete</a></td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'dashboard_bottom.php'; ?>