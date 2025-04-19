<?php
// Start session
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to cart
if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        // Get product info from the database
        $conn = new mysqli("localhost", "root", "", "ecommerce");
        $result = $conn->query("SELECT * FROM products WHERE id = $id");
        $product = $result->fetch_assoc();
        $_SESSION['cart'][$id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1,
            'image' => $product['image']
        ];
        $conn->close();
    }
}

// Display cart items
echo "<h2>Shopping Cart</h2>";

if (empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
} else {
    $total = 0;
    echo "<table><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";
    foreach ($_SESSION['cart'] as $id => $item) {
        $total += $item['price'] * $item['quantity'];
        echo "<tr>";
        echo "<td><img src='images/{$item['image']}' width='50' height='50'>{$item['name']}</td>";
        echo "<td>Rs. {$item['price']}</td>";
        echo "<td>{$item['quantity']}</td>";
        echo "<td>Rs. " . ($item['price'] * $item['quantity']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<p><strong>Total: Rs. $total</strong></p>";
    echo "<a href='checkout.php'>Proceed to Checkout</a>";
}
?>
