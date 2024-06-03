<?php
session_start();
include("../admin_template/db_conn.php");

// Calculate total items in cart
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['item_quantity'];
    }
}

// Assuming the form fields have name attributes that match these variable names
if (isset($_POST['proceed'])) {
    $_SESSION['full_name'] = $_POST['fullName'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['postal_code'] = $_POST['postalCode'];
    $_SESSION['country'] = $_POST['country'];
    $_SESSION['phone'] = $_POST['phone'];
    header("Location: payment.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        #cargoForm {
            margin-top: 100px;
            margin-left: 20px;
        }
        #proceedButton {
            margin-left: 20px;
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
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
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
        <h1>Cargo Detail</h1>
        <form id="cargoForm" method="post" action="">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required><br><br>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br><br>
            
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required><br><br>
            
            <label for="postalCode">Postal Code:</label>
            <input type="text" id="postalCode" name="postalCode" required><br><br>
            
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required><br><br>
            
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone"><br><br>
            
            <button type="submit" id="proceedButton" name="proceed">Proceed</button>
        </form>
    </div>
</body>
</html>
