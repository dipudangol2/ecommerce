<?php
// checkout.php
session_start();

// If cart is empty, redirect to products page
if (empty($_SESSION['cart'])) {
    header('Location: products.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect order details
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    // Store the order in the database
    $conn = new mysqli("localhost", "root", "", "ecommerce");

    // Serialize the cart to store it as a string
    $products = serialize($_SESSION['cart']);
    $total_amount = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }

    $sql = "INSERT INTO orders (customer_name, email, address, products, total_amount, payment_method)
            VALUES ('$name', '$email', '$address', '$products', $total_amount, '$payment_method')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>✅ Order placed successfully!</h2>";
        echo "Your order has been placed. Total: Rs. $total_amount";
        unset($_SESSION['cart']);  // Empty the cart after successful order
    } else {
        echo "❌ Error: " . $conn->error;
    }

    $conn->close();
} else {
    // Display checkout form
    echo "<h2>Checkout</h2>";
    echo "<form method='POST'>";
    echo "Name: <input type='text' name='name' required><br><br>";
    echo "Email: <input type='email' name='email' required><br><br>";
    echo "Address: <textarea name='address' required></textarea><br><br>";
    echo "Payment Method: <select name='payment_method'>
            <option value='Cash on Delivery'>Cash on Delivery</option>
            <option value='Card'>Credit/Debit Card</option>
          </select><br><br>";
    echo "<input type='submit' value='Place Order'>";
    echo "</form>";
}
?>
