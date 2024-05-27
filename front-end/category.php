<?php
include("config.php/db_connect.php");

$category_id = $_GET['id'];

$category_result = $conn->query("SELECT * FROM categories WHERE id = $category_id");
$category = $category_result->fetch_assoc();

$product_result = $conn->query("SELECT * FROM products WHERE category_id = $category_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $category['name']; ?></title>
</head>
<body>
    <h1><?php echo $category['name']; ?></h1>
    <?php
    while ($row = $product_result->fetch_assoc()) {
        echo "<div>";
        echo "<img src='" . $row['picture'] . "' alt='" . $row['name'] . "'>";
        echo "<h2>" . $row['name'] . "</h2>";
        echo "<p>Price: " . $row['price'] . "</p>";
        echo "<a href='product.php?id=" . $row['id'] . "'>View Product</a>";
        echo "</div>";
    }
    ?>
</body>