<?php 
include("../admin_template/db_conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sipariş Başarılı</title>
    <link rel="stylesheet" href="http://css/styles.css">
</head>
<body>
    <h1></h1>
    <p>Siparişiniz en kısa sürede kargoya verilecektir.</p>
</body>
</html>
<?php
// Siparişi veritabanına kaydetme işlemi
// Bu bölümde ödeme ve kargo bilgilerini alarak Orders ve OrderItems tablolarına ekleme işlemi yapılır.
// Bu işlemi yaparken öncelikle Orders tablosuna sipariş bilgileri eklenir ve daha sonra OrderItems tablosuna siparişe ait ürünler eklenir.

// Sipariş bilgilerini al
$customer_id = $_SESSION["customer_id"];
$payment_type = $_POST["payment_type"];
$shipping_type = $_POST["shipping_type"];
$shipping_address = $_POST["shipping_address"];
$shipping_city = $_POST["shipping_city"];
$shipping_zip = $_POST["shipping_zip"];
$shipping_country = $_POST["shipping_country"];
$shipping_phone = $_POST["shipping_phone"];
$shipping_email = $_POST["shipping_email"];
$shipping_note = $_POST["shipping_note"];
$shipping_cost = $_POST["shipping_cost"];
$payment_cost = $_POST["payment_cost"];
$total_cost = $_POST["total_cost"];

// Sipariş bilgilerini Orders tablosuna ekle
$sql = "INSERT INTO Orders (customer_id, payment_type, shipping_type, shipping_address, shipping_city, shipping_zip, shipping_country, shipping_phone, shipping_email, shipping_note, shipping_cost, payment_cost, total_cost) VALUES ('$customer_id', '$payment_type', '$shipping_type', '$shipping_address', '$shipping_city', '$shipping_zip', '$shipping_country', '$shipping_phone', '$shipping_email', '$shipping_note', '$shipping_cost', '$payment_cost', '$total_cost')";
$result = mysqli_query($conn, $sql);

// Sipariş bilgilerini OrderItems tablosuna ekle
$order_id = mysqli_insert_id($conn);
foreach ($_SESSION["cart"] as $product_id => $quantity) {
    $sql = "INSERT INTO OrderItems (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
    $result = mysqli_query($conn, $sql);
}

// Sipariş tamamlandıktan sonra sepeti boşalt
unset($_SESSION["cart"]);

// Sipariş tamamlandıktan sonra sipariş numarasını göster   
echo "<p>Siparişiniz başarıyla alındı. Sipariş numaranız: $order_id</p>";

// Sipariş tamamlandıktan sonra müşteriye e-posta gönder
$to = $shipping_email;
$subject = "Siparişiniz alındı";
$message = "Siparişiniz başarıyla alındı. Sipariş numaranız: $order_id";
$headers = "From:  ";mail($to, $subject, $message, $headers);

// Sipariş tamamlandıktan sonra yönlendirme yap
header("Location: order_success.php");














?>
