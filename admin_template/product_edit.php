<?php
include 'db_conn.php';

// URL'den ürün ID'sini alıyoruz
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // ID set edilmemişse ürün listesine yönlendir
    header("Location: product_list.php");
    exit();
}

// Veritabanından ürün bilgilerini alıyoruz
$sql = "SELECT * FROM product_table WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $picture = $_FILES["picture"]["name"];
    $price = $_POST["price"];
    $stock_quantity = $_POST["stock_quantity"];
    $description = $_POST["description"];
    $category_id = $_POST["category_id"];

    // Dosya yükleme işlemi
    if($picture) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($picture);
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
    } else {
        // Eğer yeni bir resim yüklenmediyse eski resmi koru
        $picture = $row["picture"];
    }

    $sql = "UPDATE `product_table` SET `name`='$name',`picture`='$picture',`price`='$price',`stock_quantity`='$stock_quantity',`description`='$description', `category_id`='$category_id' WHERE id = $id";
    
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: product_list.php?message=Data updated successfully");
    } else {
        echo "Failed: " . $sql . "<br>" . mysqli_error($conn);
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
        PRODUCT PAGE         
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
                <li><a class="dropdown-item" href="category_list.php">CATEGORY LIST</a></li>
                <li><a class="dropdown-item" href="add_category.php">ADD CATEGORY</a></li>
                <li><a class="dropdown-item" href="product_list.php">PRODUCT LIST</a></li>
                <li><a class="dropdown-item" href="add_product.php">ADD PRODUCT</a></li>
                <li><a class="dropdown-item" href="order_list.php">ORDER LIST</a></li>
            </ul>
        </li>
    </ul>
</div>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Product Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="formFile" class="form-label">Product Image:</label>
                    <input class="form-control" type="file" id="formFile" name="picture">
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Product Price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stock_quantity" class="col-sm-2 col-form-label">Stock Quantity</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="stock_quantity" name="stock_quantity">
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                                $selected = ($row["stock_quantity"] == $i) ? "selected" : "";
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description:</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?php echo $row['description']; ?></textarea>
                </div>
                <div class="row mb-3">
                    <label for="category_id" class="col-sm-2 col-form-label">Category ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="category_id" name="category_id" value="<?php echo $row['category_id']; ?>">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="product_list.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
