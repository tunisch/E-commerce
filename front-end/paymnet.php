<?php
include("../admin_template/db_conn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ödeme</title>
    <link rel="stylesheet" href="http://css/styles.css">
</head>
<body>
    <h1>Ödeme Bilgileri</h1>
    <form action="success.php" method="post">
        <label>Kredi Kartı Numarası: <input type="text" name="cardnumber"></label><br>
        <label>Son Kullanma Tarihi: <input type="text" name="expdate"></label><br>
        <label>CVV: <input type="text" name="cvv"></label><br>
        <button type="submit">Satın Al</button>
    </form>
</body>
</html>
