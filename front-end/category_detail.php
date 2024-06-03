<?php
session_start();
include("../admin_template/db_conn.php");

//get ne işe yarar ve isset ne işe yarar ?
//isset() fonksiyonu bir değişkenin tanımlı olup olmadığını kontrol eder. Eğer değişken tanımlıysa TRUE, aksi halde FALSE döner.
//$_GET[] fonksiyonu ile URL üzerinden gönderilen verileri alabiliriz. Bu fonksiyon ile URL üzerinden gönderilen verileri alabiliriz.
if(isset($_GET["id"])) {
    $category_id = $_GET["id"];
    $sql = "SELECT * FROM product_table WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
}
 
// Sepetteki ürün sayısını sepete eklenen urun sayisi kadar arttır ve azaltacak olan kod bloğu
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
    <title>Category Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .container {
            margin-top: 100px;
        }
        .card-img-top {
            width: 100%;
            height: auto;
            object-fit: cover;
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
            <h3>Category Products</h3>
        </div>
        <div class="row">
            <!-- Urunlerin listelendigi kart -->
            <!-- fetch assoc ile veritabanindan cekilen verileri dizi seklinde aliyoruz -->
            <?php while($product = $result->fetch_assoc()) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <?php 
                        $imgPath = "../admin_template/images/" . $product["picture"];
                        if(file_exists($imgPath)){
                            echo "<img src='$imgPath' class='card-img-top' alt='".$product["name"]."'>";
                        } else {
                            echo "<img src='default_image.jpg' class='card-img-top' alt='Default Image'>";
                        }
                        ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                            <p class="card-text"><?php echo $product["price"]; ?> USD</p>
                            <a href="product_detail.php?id=<?php echo $product["id"]; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
