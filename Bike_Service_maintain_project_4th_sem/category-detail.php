<?php
      require 'connection.php';

      $categoryId = $_GET['id'];

      $sql="SELECT * FROM Products WHERE category_id=$categoryId";
      $products=$conn->query($sql);

      $sql_category="SELECT * FROM Categories WHERE id=$categoryId";
      $category=$conn->query($sql_category);
      $category = $category->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    include 'head.php';
    ?>

 </head>
  <body id="top">
    <?php include 'header.php'; ?>

  <!-- Our Special section start  -->
<div class="container mb-5 mt-5 py-4">
  <div class="row pt-5">
  <h2 class="text-center mb-4"><?php echo $category['category_name'];  ?></h2>
  <div class="row mb-4">
    <?php foreach ($products as $key => $product) { ?>
      <div class="col-lg-3 mb-3">
        <div class="border rounded p-4 text-center">
        <a href="./product-detail.php?id=<?php echo $product['id']; ?>">
          <img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>" height="150" width="150">
        </a>
            <p class="mt-3 fs-5">
              <a href="./product-detail.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a>
            </p>
            <h5 class="text-danger mt-2 fs-5 ">Rs. <?php echo $product['price'] ?></h5>
        </div>
      </div>
    <?php } ?>
</div>
</div>
</div>

    <?php include 'footer.php'; ?>




  </body>
</html>
