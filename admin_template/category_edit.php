<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $order = mysqli_real_escape_string($conn, $_POST['order']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "UPDATE category_table SET name = '$name', `order` = '$order', status = '$status' WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: category_list.php?message=Data updated successfully");
    } else {
        echo "Failed: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    $sql = "SELECT * FROM category_table WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Category not found.";
        exit;
    }
} 
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:chocolate;">
        CATEGORY PAGE
    </nav>
    <div class="container">
        <ul class="nav justify-content-left">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: chocolate;">
                    ADMIN MANAGEMENT
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="admin_panel.php">ADMIN PANEL</a></li>
                    <li><a class="dropdown-item" href="admin_list.php">ADMIN LIST</a></li>
                    <li><a class="dropdown-item" href="add_admin.php">ADD ADMIN</a></li>
                    <li><a class="dropdown-item" href="admin_edit.php">EDIT ADMIN</a></li>
                    <li><a class="dropdown-item" href="category_list.php">CATEGORY LIST</a></li>
                    <li><a class="dropdown-item" href="add_category.php">ADD CATEGORY</a></li>
                    <li><a class="dropdown-item" href="category_edit.php">EDIT CATEGORY</a></li>
                    <li><a class="dropdown-item" href="product_list.php">PRODUCT LIST</a></li>
                    <li><a class="dropdown-item" href="add_product.php">ADD PRODUCT</a></li>
                    <li><a class="dropdown-item" href="product_edit.php">EDIT PRODUCT</a></li>
                    <li><a class="dropdown-item" href="order_list.php">ORDER LIST</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Category Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="category_edit.php" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" required>
                    </div>

                    <div class="col">
                        <label class="form-label">Order:</label>
                        <input type="number" class="form-control" name="order" value="<?php echo $row["order"]; ?>" required>
                    </div>

                    <div class="col">
                        <label class="form-label">Status:</label>
                        <select class="form-select" name="status" required>
                            <option value="1" <?php if($row["status"] == 1) echo "selected"; ?>>Active</option>
                            <option value="0" <?php if($row["status"] == 0) echo "selected"; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="category_list.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
