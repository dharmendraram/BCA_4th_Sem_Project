<?php
include './validation.php';
?>


<?php
require 'connection.php';

$sql_select = "SELECT * FROM users";
$result = $conn->query($sql_select);

if(isset($_GET['did']))
{
      $sql="DELETE FROM users WHERE id=$_GET[did]";
      if($conn->query($sql))
      {
            header('Location: users.php');
      }
      else{
            die($conn->error);
      }
}

?>

<?php include 'dashboard_top.php'; ?>

<div class="col-md-10" style="background:#f2f2f2; min-height:600px; border:1px solid #dddddd">
    <div class="row">
        <div class="col-12 py-3 bg-light">
            <h5>Users</h5>
        </div>
    </div>

    <div class="row bg-light mt-2">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $status= [0=>'Inactive', 1=>'Active'];
                        while($row = $result->fetch_assoc())
                        {
                            echo "<tr>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td>$row[mobile]</td>
                            <td>$row[email]</td>
                            <td>$row[address]</td>
                            <td>$row[username]</td>
                            <td>$row[password]</td>
                            <td>$row[type]</td>
                            <td>".$status[$row['status']]."</td>
                            <td><a href='users.php?did=$row[id]' class='btn btn-danger' onclick='return confirm(`Are you sure?`)'>Delete</a></td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php include 'dashboard_bottom.php'; ?>