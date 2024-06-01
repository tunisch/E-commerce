<?php
include("../admin_template/db_conn.php");




// Get 10 products
$product_sql = "SELECT * FROM product_table LIMIT ";/* 
$product_result = $conn->query($product_sql); */

// Get all categories
$category_sql = "SELECT * FROM category_table";
$category_result = $conn->query($category_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



    <style>
        .container{
            margin-top: 100px;
        }
    </style>



</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">E-commerce Platform</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Anasayfa.php">Home</a>
                    
                    <li class="nav-item">
                        <button>
                            <a class="nav-link" href="../admin_template/admin_login.php">Admin Login</a>
                        </button>
                    </li>
                    
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav>

    <!-- Navbar end -->
    <div class="container">
        <!-- Categories Section -->
        <div class="text-center mb-4">
            <h3>Categories</h3>
        </div>
        <div class="row">
            <?php while($category = $category_result->fetch_assoc()) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $category["name"]; ?></h5>
                            <p class="card-text"><?php echo $category["description"]; ?></p>
                            <a href="category_detail.php?id=<?php echo $category["id"]; ?>" class="btn btn-primary">View Products</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Products Section -->
        <div class="text-center mb-4">
            <h3>Products</h3>
        </div>
        <div class="row">  
        <?php $product_result = $conn->query("SELECT * FROM product_table");
             while($product = $product_result->fetch_assoc()) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?php echo $product["picture"]; ?>" class="card-img-top" alt="<?php echo $product["name"]; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                            <p class="card-text"><?php echo $product["price"]; ?> USD</p>
                            <a href="product_detail.php?id=<?php echo $product["id"]; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php } 
            ?>
        </div>
    </div>
    
    




</body>
</html>