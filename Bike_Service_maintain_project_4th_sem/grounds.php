<?php include 'dashboard_top.php'; ?>
<?php
require 'connection.php';
if(isset($_POST['btnAddGround']))
{
    $title= $_POST['title'];
    $type= $_POST['type'];
    $size= $_POST['size'];
    $address= $_POST['address'];
    $capacity= $_POST['capacity'];
    $status= $_POST['status'];

    $sql = "INSERT INTO grounds VALUES (null,'$title','$type','$size','$address','$capacity','$status')";

    if($conn->query($sql))
    {
        echo '<script>alert("Ground Added.")</script>';
    }
    else{
        echo '<script>alert("Failed to add Ground.")</script>';
    }
}
    if(isset($_GET['eid']))
    {
        $sql_select_single = "SELECT * FROM grounds WHERE id=$_GET[eid]";
        $result_single = $conn->query($sql_select_single);
        $ground = $result_single->fetch_assoc();
        
    }
if(isset($_POST['btnUpdateGround']))    
{
    $title= $_POST['title'];
    $type= $_POST['type'];
    $size= $_POST['size'];
    $address= $_POST['address'];
    $capacity= $_POST['capacity'];
    $status= $_POST['status'];

    $sql = "UPDATE grounds SET  title='$title', type='$type', size='$size', address='$address', capacity='$capacity', status=$status WHERE id=$_GET[eid]";

    if($conn->query($sql))
    {
        //echo '<script>alert("Ground Updated.")</script>';
        header('Location: grounds.php?msg=Ground Updated.');
    }
    else{
        //echo $sql;
        //echo $conn->error;
         echo '<script>alert("Failed to update Ground.")</script>';
    }
}
    if(isset($_GET['did']))
    {
        $sql_delete = "DELETE FROM grounds WHERE id = $_GET[did]";
        if($conn->query($sql_delete)){
            //echo '<script>alert("Ground Deleted")</script>';
            header('Location: grounds.php?msg=Ground Deleted');

        }
        else{
            die($conn->error);
        }   
    }
    if(isset($_GET['msg']))
    {
        echo'<script>alert("'.$_GET['msg'].'")</script>';
    }

    $sql_select = "SELECT * FROM grounds";
    $result = $conn->query($sql_select);

?>
<div class="col-md-9 bg-secondary">
    <div class="row">
        <div class="col-12 bg-success">
            <h5 class="text-light">Grounds</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
        <form action="" method="POST">
            <div class="form-group mb-3">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control"
                value="<?php if(isset($_GET['eid'])) echo $ground['title']; ?>">
            </div>
            <div class="form-group mb-3">
                <label for="">Type</label>
                <input type="text" name="type" class="form-control"
                value="<?php if(isset($_GET['eid'])) echo $ground['type']; ?>">
            </div>
            <div class="form-group mb-3">
                <label for="">Size</label>
                <input type="text" name="size" class="form-control"
                value="<?php if(isset($_GET['eid'])) echo $ground['size']; ?>">
            </div>
            <div class="form-group mb-3">
                <label for="">Address</label>
                <input type="text" name="address" class="form-control"
                value="<?php if(isset($_GET['eid'])) echo $ground['address']; ?>">
            </div>
            <div class="form-group mb-3">
                <label for="">Capacity</label>
                <input type="text" name="capacity" class="form-control"
                value="<?php if(isset($_GET['eid'])) echo $ground['capacity']; ?>">
            </div>
            <div class="form-group mb-3">
                <label for="">Status</label>
                <input type="radio" name="status" value="1" id="active"
                <?php if(isset($_GET['eid'])&& $ground['status']) echo 'checked'; ?>/>
                <label for="active">Active</label>
                <input type="radio" name="status" value="0" id="inactive"
                <?php if(isset($_GET['eid'])&& !$ground['status']) echo 'checked'; ?>/>
                <label for="inactive">Inactive</label>
            </div>
            <div class="form-group">
                <?php if(isset($_GET['eid'])) {
                  echo '<input type="submit" name="btnUpdateGround" class="btn btn-primary" value="Update Ground"/>';
                    } 
                    else { 
                    echo '<input type="submit" name="btnAddGround" class="btn btn-primary" value="Add Ground"/>';
                   } 
                ?>
            </div>
        </form>
        </div>
        </div>

    <div class="row bg-light mt-2">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Address</th>
                        <th>Capacity</th>
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
                            <td>$row[title]</td>
                            <td>$row[type]</td>
                            <td>$row[size]</td>
                            <td>$row[address]</td>
                            <td>$row[capacity]</td>
                            <td>".$status[$row['status']]."</td>
                            <td><a href='grounds.php?eid=$row[id]' class='btn btn-info'>Edit</a></td>
                            <td><a href='grounds.php?did=$row[id]' class='btn btn-danger' onclick='return confirm(`Are you sure?`)'>Delete</a></td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'dashboard_bottom.php'; ?>