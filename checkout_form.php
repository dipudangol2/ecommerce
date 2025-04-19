<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h2>Checkout Form</h2>
    <form action="checkout.php" method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Address:</label><br>
        <textarea name="address" required></textarea><br><br>

        <label>Products (comma-separated):</label><br>
        <input type="text" name="products" placeholder="Laptop, Phone" required><br><br>

        <label>Total Amount:</label><br>
        <input type="number" name="total" step="0.01" required><br><br>

        <label>Payment Method:</label><br>
        <select name="payment_method">
            <option value="COD">Cash on Delivery</option>
            <option value="Card">Credit/Debit Card</option>
        </select><br><br>

        <input type="submit" value="Place Order">
    </form>
</body>
</html>
