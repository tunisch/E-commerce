<?php
    include("../db.php");
    
// Ürünlerin dizisi (gerçek veritabanından alınabilir)
$product_id = $_GET['id'];

$product_result = $conn->query("SELECT * FROM products WHERE id = $product_id");
$product = $product_result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product['name']; ?></title>
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <img src="<?php echo $product['picture']; ?>" alt="<?php echo $product['name']; ?>">
    <p>Price: <?php echo $product['price']; ?></p>
    <p>Stock Quantity: <?php echo $product['stock_quantity']; ?></p>
    <p>Description: <?php echo $product['description']; ?></p>
    <button onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>

    <script>
    function addToCart(productId) {
        // Implement add to cart functionality
        console.log('Product added to cart: ' + productId);
    }
    </script>
</body>
</html>