<?php
include("../admin_template/db_conn.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $category_result = $conn->query("SELECT * FROM category_table WHERE id = $id");
    $category = $category_result->fetch_assoc();

    $product_result = $conn->query("SELECT * FROM product_table WHERE category_id = $id");
} else {
    echo "Invalid category ID.";
    exit();
}
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
</html>
