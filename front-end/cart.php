<?php
session_start();
include("../admin_template/db_conn.php");

// Check if cart is empty
if (empty($_SESSION['cart'])) {
    // Redirect to some page, or show a message that the cart is empty
    exit("Your cart is empty.");
}

// Remove item from cart
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $id = $_GET['id'];
    removeItemFromCart($id, $conn);
    header("Location: cart.php");
    exit();
}

// Update item quantity in cart
if (isset($_POST['update_quantity']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $operation = $_POST['update_quantity'];
    if (isset($_SESSION['cart'][$id])) {
        updateItemQuantity($id, $operation, $conn);
    }
    header("Location: cart.php");
    exit();
}

// Calculate total items in cart
$cart_count = calculateCartItemCount($_SESSION['cart']);

// Function to remove item from cart
function removeItemFromCart($id, $conn) {
    if (isset($_SESSION['cart'][$id])) {
        $removed_quantity = $_SESSION['cart'][$id]['item_quantity'];
        $sql = "UPDATE product_table SET stock_quantity = stock_quantity + ? WHERE id = ?";
        executeUpdateQuery($sql, $conn, [$removed_quantity, $id]);
        unset($_SESSION['cart'][$id]);
    }
}

// Function to update item quantity in cart
function updateItemQuantity($id, $operation, $conn) {
    $current_quantity = $_SESSION['cart'][$id]['item_quantity'];
    $new_quantity = $current_quantity;

    // Get the stock quantity for the product
    $row = getStockQuantity($id, $conn);
    $stock_quantity = $row['stock_quantity'];

    // Check if the operation is increment and there is enough stock
    if ($operation == 'increment') {
        // Check if the current quantity is less than the stock quantity
        if ($current_quantity < $stock_quantity) {
            $new_quantity += 1;
            $sql = "UPDATE product_table SET stock_quantity = stock_quantity - 1 WHERE id = ?";
            executeUpdateQuery($sql, $conn, [$id]);
        } else {
            // Display a notification if there is no stock available
            echo "<script>alert('There is no more stock available for this product.')</script>";
        }
    } 
    // Check if the operation is decrement and the current quantity is greater than 1
    elseif ($operation == 'decrement' && $current_quantity > 1) {
        $new_quantity -= 1;
        $sql = "UPDATE product_table SET stock_quantity = stock_quantity + 1 WHERE id = ?";
        executeUpdateQuery($sql, $conn, [$id]);
    }

    // Update the quantity in the cart
    $_SESSION['cart'][$id]['item_quantity'] = $new_quantity;
}

// Function to calculate total items in cart
function calculateCartItemCount($cart) {
    $cart_count = 0;
    if (isset($cart)) {
        foreach ($cart as $item) {
            $cart_count += $item['item_quantity'];
        }
    }
    return $cart_count;
}

// Function to get stock quantity for a product
function getStockQuantity($id, $conn) {
    $sql = "SELECT stock_quantity FROM product_table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to execute update query
function executeUpdateQuery($sql, $conn, $params) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('i', count($params)), ...$params);
    $stmt->execute();
}

// Close the database connection
mysqli_close($conn); 
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
        .quantity-controls {
            display: flex;
            align-items: center;
        }
        .quantity-controls button {
            border: none;
            background: none;
            font-size: 1.2em;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="Anasayfa.php">E-commerce Platform</a>
            <ul class="navbar-nav ms-auto">
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
    </nav>
    
    <div class="container">
        <h2>Your Cart</h2>
        
        <?php
        // Check if the cart is empty
        if ($cart_count == 0) {  
            echo "<p>Your cart is empty.</p>";
        } else {
            echo '<table class="table table-bordered">';
            echo '<thead><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr></thead>';
            echo '<tbody>';
            $total_price = 0;
            foreach ($_SESSION['cart'] as $id => $product) {
                if (isset($product['item_name']) && isset($product['product_price']) && isset($product['item_quantity'])) {
                    $item_total = $product['product_price'] * $product['item_quantity'];
                    $total_price += $item_total;
                    echo "<tr>
                        <td>{$product['item_name']}</td>
                        <td>{$product['product_price']} USD</td>
                        <td>
                            <form method='post' action='cart.php' class='d-inline'>
                                <div class='quantity-controls'>
                                    <button type='submit' name='update_quantity' value='decrement'>-</button>
                                    <input type='hidden' name='id' value='{$id}'>
                                    <input type='number' name='quantity' value='{$product['item_quantity']}' min='1' style='width: 50px; text-align: center;' readonly>
                                    <button type='submit' name='update_quantity' value='increment'>+</button>
                                </div>
                            </form>
                        </td>
                        <td>{$item_total} USD</td>
                        <td><a href='cart.php?action=remove&id=$id' class='btn btn-danger btn-sm'>Remove</a></td>
                    </tr>";
                }
            }
            echo '<tr><td colspan="3" class="text-end"><strong>Total</strong></td><td><strong>' . $total_price . ' USD</strong></td><td></td></tr>';
            echo '</tbody>';
            echo '</table>';
            echo '<div class="text-end"><a href="cargo_detail.php" class="btn btn-primary">Proceed</a></div>';
        }

        ?>
    </div>
</body>
</html>