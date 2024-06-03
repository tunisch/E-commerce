<?php
session_start();
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

// Add product to cart
if(isset($_POST["add_to_cart"])) {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["hidden_name"];
    $product_price = $_POST["hidden_price"];
    $quantity = $_POST["quantity"];

    if(isset($_SESSION["cart"])) {
        $item_array_id = array_column($_SESSION["cart"], "product_id");
        if(!in_array($product_id, $item_array_id)) {
            $count = count($_SESSION["cart"]);
            $item_array = array(
                'product_id' => $product_id,
                'item_name' => $product_name,
                'product_price' => $product_price,
                'item_quantity' => $quantity
            );
            $_SESSION["cart"][$count] = $item_array;
        } else {
            // Update quantity if product is already in the cart
            foreach($_SESSION["cart"] as $key => $value) {
                if($value["product_id"] == $product_id) {
                    $_SESSION["cart"][$key]["item_quantity"] += $quantity;
                }
            }
        }
    } else {
        $item_array = array(
            'product_id' => $product_id,
            'item_name' => $product_name,
            'product_price' => $product_price,
            'item_quantity' => $quantity
        );
        $_SESSION["cart"][0] = $item_array;
    }

    // Update stock in database
    $new_stock = $product["stock_quantity"] - $quantity;
    $update_stock_sql = "UPDATE product_table SET stock_quantity = ? WHERE id = ?";
    $stmt = $conn->prepare($update_stock_sql);
    $stmt->bind_param("ii", $new_stock, $product_id);
    $stmt->execute();

    // Redirect to cart page
    header("Location: cart.php");
    exit();
}

$cart_count = 0;
if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $item) {
        $cart_count += $item['item_quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <!-- Navbar end -->

    <div class="container">
        <div class="text-center mb-4">
            <h3><?php echo $product["name"]; ?></h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img src="../admin_template/images/<?php echo $product["picture"]; ?>" class="img-fluid" alt="<?php echo $product["name"]; ?>">
            </div>
            <div class="col-md-6">
                <h4><?php echo $product["price"]; ?> USD</h4>
                <p><?php echo $product["description"]; ?></p>
                <p>Stock Quantity: <?php echo $product["stock_quantity"]; ?></p>
                <form method="post" action="product_detail.php?id=<?php echo $product["id"]; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
                    <input type="hidden" name="hidden_name" value="<?php echo $product["name"]; ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $product["price"]; ?>">
                    <label for="quantity">Quantity:</label>
                    <select name="quantity" id="quantity">
                        <?php
                          for($i = 1; $i <= $product["stock_quantity"]; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                    <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
