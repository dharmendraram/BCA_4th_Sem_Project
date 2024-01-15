<?php
include './validation.php';
?>

<?php
require 'connection.php';
    if(isset($_GET['did']))
    {
        $sql_delete = "DELETE FROM Categories WHERE id = $_GET[did]";
        if($conn->query($sql_delete)){
            //echo '<script>alert("Ground Deleted")</script>';
            header('Location: category.php?msg=Category Deleted');

        }
        else{
            die($conn->error);
        }
    }
    if(isset($_GET['msg']))
    {
        echo'<script>alert("'.$_GET['msg'].'")</script>';
    }

    $sql_select = "SELECT * FROM Categories";
    $result = $conn->query($sql_select);

?>

<?php include 'dashboard_top.php'; ?>

<div class="col-md-10" style="background:#f2f2f2; min-height:600px; border:1px solid #dddddd">
                <div class="row">
                    <div class="col-12 bg-light py-3 d-flex align-items-center justify-content-between">
                        <h5>Category</h5>
                        <div>
                        <h6 class="mb-0 fs-6">
                            <a href="addCategory.php" class="text-white btn-bg p-2 rounded">
                            <i class="bi bi-bag"></i> Add Category</a>
                         </h6>
                    </div>
                    </div>
                </div>

    <div class="row bg-light mt-2">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id  </th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $status= [0=>'Inactive', 1=>'Active'];
                        while($row = $result->fetch_assoc())
                        {
                            echo "<tr>
                            <td>$row[id]</td>
                            <td>$row[category_name]</td>
                            <td>".$status[$row['Status']]."</td>
                            <td><a href='addCategory.php?eid=$row[id]' class='btn btn-info'>Edit</a></td>
                            <td><a href='category.php?did=$row[id]' class='btn btn-danger' onclick='return confirm(`Are you sure?`)'>Delete</a></td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
            </div>
<?php include 'dashboard_bottom.php'; ?>