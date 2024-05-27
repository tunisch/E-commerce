<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
</head>
<body>
    <h1>Payment</h1>
    <form method="post" action="order_success.php">
        Credit Card Number: <input type="text" name="card_number"><br>
        Expiry Date: <input type="text" name="expiry_date"><br>
        CVV: <input type="text" name="cvv"><br>
        <input type="submit" value="Buy">
    </form>
</body>
</html>