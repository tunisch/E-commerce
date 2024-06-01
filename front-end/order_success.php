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
    <h1>Siparişiniz Başarıyla Alındı!</h1>
    <p>Teşekkür ederiz. Siparişiniz başarıyla tamamlandı.</p>
</body>
</html>
<?php
// Siparişi veritabanına kaydetme işlemi
// Bu bölümde ödeme ve kargo bilgilerini alarak Orders ve OrderItems tablolarına ekleme işlemi yapılır.
?>
