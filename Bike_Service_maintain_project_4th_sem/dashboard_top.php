<html>
<head><?php include 'head.php'; ?>
</head>
<body>          
   <div class="container-fluid">
        <div class="row align-items-center" style="color:white">
            <div class="col-12 bg-foot d-flex align-items-center justify-content-between">
                <a href="dashboard.php">
                    <!-- <img src="./img/logo.png" width="90" alt=""> -->
                    <h2 class="text-light fw-bold py-2">Admin Dashboard</h2>
            </a>
                <h4 class="mb-0  text-success fw-bold">Welcome <?php echo $_SESSION['username'] ?> </h1>
                <div>
                    <h5 class="mb-0 d-flex align-items-center pe-2 fs-6">
                    <i class="bi bi-arrow-right-square pe-1"></i>    
                    <a href="logout.php" class="text-light">Logout</a>
                    </h5>
                </div>
            </div>
        </div>
        <div class="row" style="height:600px;">
            <div class="col-md-2 p-0" style="background:#eeeeee; min-height: 600px">
                <ul class="list-group dash-items">
                    <li class="list-group-item pt-3"><a class="d-block" href="dashboard.php"><i class="bi bi-house pe-2"></i> Dashboard</a></li>
                    <li class="list-group-item pt-2"><a class="d-block" href="category.php"><i class="bi bi-grid pe-2"></i> Category</a></li>
                    <li class="list-group-item pt-2"><a class="d-block" href="products.php"><i class="bi bi-basket pe-2"></i> Products</a></li>
                    <li class="list-group-item pt-2"><a class="d-block" href="users.php"><i class="bi bi-people pe-2"></i> Users</a></li>
                    <li class="list-group-item pt-2"><a class="d-block" href="orders.php"><i class="bi bi-basket-fill pe-2"></i> Orders</a></li>
                    <li class="list-group-item pt-2"><a class="d-block" href="services.php"><i class="bi bi-shop pe-2"></i> Services</a></li>
                    <li class="list-group-item pt-2"><a class="d-block" href="bookings.php"><i class="bi bi-briefcase-fill pe-2"></i> Bookings</a></li>
                </ul>
            </div>      
