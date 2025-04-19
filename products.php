<?php
// products.php

// Database connection
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Our Products</h2><div class='product-grid'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-card'>";
        echo "<img src='images/{$row['image']}' alt='{$row['name']}'>";
        echo "<h3>{$row['name']}</h3>";
        echo "<p>{$row['description']}</p>";
        echo "<p>Price: Rs. {$row['price']}</p>";
        echo "<a href='cart.php?action=add&id={$row['id']}'>Add to Cart</a>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "No products available.";
}

$conn->close();
?>
