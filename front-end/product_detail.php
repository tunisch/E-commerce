<?php
include("../admin_template/db_conn.php");

if(isset($_GET["id"])) {
    $product_id = $_GET["id"];
    $sql = "SELECT * FROM product_table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

if(isset($_POST["add_to_cart"])) {
    $product_id = $_POST["product_id"];
    // Sepete ekleme işlemleri burada yapılabilir
    // Örnek olarak $_SESSION kullanarak sepet işlemi yapılabilir.
    $_SESSION["cart"][$product_id] = 1; // miktar eklenebilir
    header("Location: card.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
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
                        <a class="nav-link" href="payment.php">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">Add Category</a>
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
        <div class="text-center mb-4">
            <h3><?php echo $product["name"]; ?></h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $product["picture"]; ?>" class="img-fluid" alt="<?php echo $product["name"]; ?>">
            </div>
            <div class="col-md-6">
                <h4><?php echo $product["price"]; ?> USD</h4>
                <p><?php echo $product["description"]; ?></p>
                <p>Stock Quantity: <?php echo $product["stock_quantity"]; ?></p>
                <form method="post" action="product_detail.php?id=<?php echo $product["id"]; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
                    <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
