<?php
include './validation.php';
?>


<?php
require 'connection.php';

if(isset($_GET['did']))
    {
        $sql_delete = "DELETE FROM Services WHERE id = $_GET[did]";
        if($conn->query($sql_delete)){
            header('Location: services.php?msg=Service Deleted');
        }
        else{
            die($conn->error);
        }
    }

    $service_sql = "SELECT * FROM Services ";
    $result_service = $conn->query($service_sql);
    ?>


<?php include 'dashboard_top.php'; ?>

<div class="col-md-10" style="background:#f2f2f2; min-height:600px; border:1px solid #dddddd">
    <div class="row">
        <div class="col-12 bg-light py-3 d-flex align-items-center justify-content-between">
            <h5>Services</h5>

            <div>
                <h5 class="mb-0 fs-6">
                <a href="addService.php" class="text-white btn-bg p-2 rounded">
                <i class="bi bi-plus-lg"></i> Add Service</a>
                </h5>
            </div>
        </div>
    </div>
    <div class="row bg-light mt-2">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = $result_service->fetch_assoc())
                        {
                            echo "<tr>
                            <td>$row[id]</td>
                            <td>$row[title]</td>
                            <td>$row[price]</td>
                            <td><img src='$row[image]' style='height: 60px; width: 60px; object-fit: contain' /></td>
                            <td>$row[description]</td>
                            <td><a href='services_form.php?eid=$row[id]' class='btn btn-info'>Edit</a></td>
                            <td><a href='services.php?did=$row[id]' class='btn btn-danger' onclick='return confirm(`Are you sure?`)'>Delete</a></td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'dashboard_bottom.php'; ?>
