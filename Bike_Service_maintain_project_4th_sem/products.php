<?php
include './validation.php';
?>


<?php
require 'connection.php';

if(isset($_GET['did']))
{
    $sql_delete = "DELETE FROM Products WHERE id = $_GET[did]";
    if($conn->query($sql_delete)){
        header('Location: products.php?msg=Product Deleted');
    }
    else{
        die($conn->error);
    }
}

$product_sql = "SELECT * FROM Products ";
$result_product = $conn->query($product_sql);

if(isset($_GET['msg']))
{
    echo '<script> alert("Product Deleted.")</script>';
}
?>


<?php include 'dashboard_top.php'; ?>


<div class="col-md-10" style="background:#f2f2f2; min-height:600px; border:1px solid #dddddd">
    <div class="row mb-2">
        <div class="col-12 bg-light py-3 d-flex align-items-center justify-content-between">
            <h5>Products</h5>

            <div>
                <h5 class="mb-0 fs-6">
                <a href="addProduct.php" class="text-white btn-bg p-2 rounded">
                <i class="bi bi-plus-lg"></i> Add Product</a>
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
                        <th>Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Category_id</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $status= [0=>'Inactive', 1=>'Active'];
                        while($row = $result_product->fetch_assoc())
                        {
                            echo "<tr>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td><img src='$row[image]' style='height: 50px; width: 50px; padding:5px' /></td>
                            <td>$row[quantity]</td>
                            <td>$row[price]</td>
                            <td>$row[category_id]</td>
                            <td>$row[description]</td>
                            <td>".$status[$row['status']]."</td>
                            <td><a href='products_form.php?eid=$row[id]' class='btn btn-info'>Edit</a></td>
                            <td><a href='products.php?did=$row[id]' class='btn btn-danger' onclick='return confirm(`Are you sure?`)'>Delete</a></td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'dashboard_bottom.php'; ?>
