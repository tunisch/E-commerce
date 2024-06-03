<?php
// Session başlat
session_start();

// Veritabanı bağlantısı
include("../admin_template/db_conn.php");

// Satın alma butonu tıklanmışsa - sipariş detaylarını orders tablosuna ekleyin
if (isset($_POST['buy'])) {
    $id = $_SESSION['id'];
    $cardNumber = $_POST['card_number'];
    $expiryDate = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Güvenlik için hazırlanmış ifadeleri kullanın
    $stmt = $conn->prepare("INSERT INTO orders (id, card_number, expiry_date, cvv) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id, $cardNumber, $expiryDate, $cvv);

    if ($stmt->execute()) {
        // Siparişler başarıyla eklendi
        // order_success sayfasına yönlendir
        header("Location: order_success.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Veritabanı bağlantısını kapat
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Payment</h2>
        <form id="paymentForm" method="post" action="">
            <div class="mb-3">
                <label for="card_number" class="form-label">Credit Card Number</label>
                <input type="text" class="form-control" id="card_number" name="card_number" required>
            </div>
            <div class="mb-3">
                <label for="expiry_date" class="form-label">Expiration Date</label>
                <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
            </div>
            <div class="mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>
            <button type="submit" class="btn btn-primary" name="buy">Buy</button>
        </form>
    </div>
</body>
</html>
