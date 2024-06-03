<?php
session_start();
include("../admin_template/db_conn.php");

// Assign session variables to local variables
$product_name = $_SESSION['product_name'];
$product_price = $_SESSION['product_price'];
$quantity = $_SESSION['quantity'];
$full_name = $_SESSION['full_name'];
$phone = $_SESSION['phone'];
$address = $_SESSION['address'];
$city = $_SESSION['city'];
$postal_code = $_SESSION['postal_code'];
$country = $_SESSION['country'];
$card_number = $_SESSION['card_number'];
$expiry_date = $_SESSION['expiry_date'];
$cvv = $_SESSION['cvv'];

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 100px;
        }
        .product-image {
            max-width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Order Success</h2>
        <p>Your order has been successfully placed.</p>
        <!-- Display order details here -->
        <p>Order Details:</p>
        <p>Product Name: <?php echo $product_name; ?></p>
        <p>Product Price: <?php echo $product_price; ?></p>
        <p>Quantity: <?php echo $quantity; ?></p>
        <p>Full Name: <?php echo $full_name; ?></p>
        <p>Phone: <?php echo $phone; ?></p>
        <p>Address: <?php echo $address; ?></p>
        <p>City: <?php echo $city; ?></p>
        <p>Postal Code: <?php echo $postal_code; ?></p>
        <p>Country: <?php echo $country; ?></p>
        <p>Card Number: <?php echo $card_number; ?></p>
        <p>Expiry Date: <?php echo $expiry_date; ?></p>
        <p>CVV: <?php echo $cvv; ?></p>
        <p>Your order will be shipped soon.</p>
        <p>Thank you for shopping with us!</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
