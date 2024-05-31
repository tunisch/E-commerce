<?php
include("../admin_template/db_conn.php");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Shipping Information</title>
</head>
<body>
    <h1>Shipping Information</h1>
    <form method="post" action="payment.php">

        Name: <input type="text" name="customer_name"><br>
        Phone: <input type="text" name="customer_phone"><br>
        <input type="submit" value="Proceed to Payment">
    </form>
    <br>

    <button>
        <a href="card.php">Back to Card</a>
    </button>
     
</body>
</html>