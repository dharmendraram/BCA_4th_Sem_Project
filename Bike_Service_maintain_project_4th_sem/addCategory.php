<?php
include './validation.php';
?>


<?php
require 'connection.php';
if(isset($_POST['btnAddCategory']))
{
    

    $err=[];
    if (isset($_POST['cname']) && !empty($_POST['cname']))
    {
        $cname= $_POST['cname'];
        if (!preg_match ("/^[A-Za-z\- ]+(?: [A-Za-z\- ]+)?$/", $cname) )
        {
            $err['cname']="*Category name must be in strings";
        }
    }else{
        $err['cname']="*Enter category name"; 
    }

    $count = 1;
    if (isset($_POST['cname'])) {
        $slug = $_POST['cname'];
        $query = "SELECT * FROM Categories WHERE category_name = '$slug'";

        $new = $conn->query($query);
        if ($new->num_rows > 0) {
            $count = 0;
            echo '<script>alert("Category Already exist.")</script>';
        }
    }
    
    if(count($err)==0)
    {
        if ($count) {
            $status= $_POST['status'];
    
            $sql = "INSERT INTO Categories VALUES (null,'$cname','$status')";
        
            if($conn->query($sql))
            {
                echo '<script>alert("Category Added.")</script>';
            }
            else{
                echo '<script>alert("Failed to add Category.")</script>';
            }
        }
        
    }

    
}
        
if(isset($_GET['eid']))
{
    $sql_select_single = "SELECT * FROM Categories WHERE id=$_GET[eid]";
    $result_single = $conn->query($sql_select_single);
    $category = $result_single->fetch_assoc();
            
}


if(isset($_POST['btnUpdateCategory']))    
{
    $err=[];
    if (isset($_POST['cname']) && !empty($_POST['cname']))
    {
        $cname= $_POST['cname'];
        if (!preg_match ("/^[A-Za-z\- ]+(?: [A-Za-z\- ]+)?$/", $cname) )
        {
            $err['cname']="*Category name must be in strings";
        }
    }

    $count = 1;
    if (isset($_POST['cname'])) {
        $slug = $_POST['cname'];
        $id = $_GET['eid'];
        $query = "SELECT * FROM Categories WHERE `id` != $id AND `category_name` = '$slug'";

        $new = $conn->query($query);
        if ($new->num_rows > 0) {
            $count = 0;
            echo '<script>alert("Category has been already exist.")</script>';
        }
    }

    if(count($err)==0)
    {
        if ($count) {
            $status= $_POST['status'];

            $sql = "UPDATE Categories SET  category_name='$cname',Status=$status WHERE id=$_GET[eid]";
    
            if($conn->query($sql))
            {
                header('Location: category.php?msg=Category Updated.');
            }
            else{
                echo '<script>alert("Failed to update Category.")</script>';
            }
        }
    }
    if(isset($_GET['msg']))
    {
        echo'<script>alert("'.$_GET['msg'].'")</script>';
    }
}
?>

<?php include 'dashboard_top.php'; ?>

<div class="col-md-10" style="background:#f2f2f2; min-height:600px; border:1px solid #dddddd">
      <div class="row">
            <div class="col-12 py-3 bg-light">
                  <h5>Category</h5>
            </div>
      </div>

      <div class="row pt-3">
            <div class="col-md-8 offset-md-2">
                  <form action="" method="POST">
                        <div class="form-group mb-3">
                              <label class="form-label">Category_Name</label>
                              <input type="text" name="cname" class="form-control"
                                    value="<?php if(isset($_GET['eid'])) echo $category['category_name']; ?>">
                              <br>
                              <h6 style="color:red">
                                    <?php 
                if(isset($err['cname']))
                {
                    echo $err['cname'];
                }
                ?>
                              </h6>
                        </div>
                        <div class="form-group mb-3">
                              <label class="form-label">Status</label>
                              <input type="radio" name="status" value="1" id="active"
                                    <?php if(isset($_GET['eid'])&& $category['Status']) echo 'checked'; ?> />
                              <label for="active">Active</label>
                              <input type="radio" name="status" value="0" id="inactive"
                                    <?php if(isset($_GET['eid'])&& !$category['Status']) echo 'checked'; ?> />
                              <label for="inactive">Inactive</label>
                        </div>
                        <div class="form-group">
                              <?php if(isset($_GET['eid'])) {
                  echo '<input type="submit" name="btnUpdateCategory" class="btn btn-bg text-light" value="Update Category"/>';
                    } 
                    else { 
                    echo '<input type="submit" name="btnAddCategory" class="btn btn-bg text-light" value="Add Category"/>';
                   } 
                ?>
                        </div>
                  </form>
            </div>
      </div>
</div>

<?php include 'dashboard_bottom.php'; ?>