<?php
session_start();
include("../admin_template/db_conn.php");

// 10 ürünü al
$product_sql = "SELECT * FROM product_table LIMIT 10"; 
$product_result = $conn->query($product_sql); 

// Sadece aktif olan kategorileri al ve 'order' sütununa göre sırala
$category_sql = "SELECT * FROM category_table WHERE status = 1 ORDER BY `order` ASC";
$category_result = $conn->query($category_sql);

// Sepetteki ürün sayısını sepete eklenen urun sayisi kadar arttır ve azaltacak olan kod bloğu
$cart_count = 0;
if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $item) {
        $cart_count += $item['item_quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .container {
            margin-top: 100px;
        }
        .cart-count {
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            position: absolute;
            top: 0;
            right: 0;
        }
        .product-image {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="Anasayfa.php">E-commerce Platform</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="../admin_template/admin_login.php">Admin Login</a>
                    </li>
                </ul>
                <form class="d-flex me-auto">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <i class="bi bi-cart4"></i>
                            <span class="cart-count badge bg-danger"><?php echo $cart_count; ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Navbar sonu -->
    <div class="container"> 
        <!-- Kategoriler Bölümü -->
        <div class="text-center mb-4">
            <h3>Categories</h3>
        </div>
        <div class="row">
            <?php while($category = $category_result->fetch_assoc()) { ?>
                <div class="col-md-3 mb-4">
                    <div class="product-cart">
                        <div class="cart-body">
                            <h5 class="cart-title"><?php echo $category["name"]; ?></h5>
                            <a href="category_detail.php?id=<?php echo $category["id"]; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Ürünler Bölümü -->
        <div class="text-center mb-4">
            <h3>Products</h3>
        </div>
        <div class="row">
            <?php while($product = $product_result->fetch_assoc()) { ?>
                <div class="col-md-3 mb-4">
                    <div class="product-cart">
                        <?php 
                        $imgPath = "../admin_template/images/" . $product["picture"];
                        if(file_exists($imgPath)){
                            echo "<img src='$imgPath' class='product-image' alt='".$product["name"]."'>";
                        } else {
                            echo "<img src='default_image.jpg' class='product-image' alt='Default Image'>";
                        }
                        ?>
                        <div class="cart-body">
                            <h5 class="cart-title"><?php echo $product["name"]; ?></h5>
                            <p class="cart-text"><?php echo $product["price"]; ?> USD</p>
                            <a href="product_detail.php?id=<?php echo $product["id"]; ?>" class="btn btn-secondary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer Bölümü -->
    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 E-commerce Platform:
            <a class="text-dark" href="https://ecommerce-platform.com/">ecommerce-platform.com</a>
        </div>
    </footer>
</body>
</html>
