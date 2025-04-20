<?php
// categories.php
$conn = new mysqli("localhost", "root", "", "ecommerce1");

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// HTML + CSS Styling (inline for simplicity)
echo "
<!DOCTYPE html>
<html>
<head>
    <title>Categories & Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f4f4f4;
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        h3 {
            margin-top: 40px;
            color: #444;
            border-left: 5px solid #007BFF;
            padding-left: 10px;
        }
        .products {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .product-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 220px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: scale(1.02);
        }
        .product-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }
        .product-details {
            padding: 15px;
        }
        .product-details strong {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .product-details p {
            font-size: 14px;
            color: #555;
        }
        .price {
            color: #007BFF;
            font-weight: bold;
            margin-top: 8px;
        }
    </style>
</head>
<body>
<h2>Product Categories & Items</h2>
";

$cat_result = $conn->query("SELECT * FROM categories");

if ($cat_result->num_rows > 0) {
    while ($cat = $cat_result->fetch_assoc()) {
        echo "<h3>{$cat['name']}</h3>";

        $cat_id = $cat['id'];
        $prod_result = $conn->query("SELECT * FROM products WHERE category_id = $cat_id");

        if ($prod_result->num_rows > 0) {
            echo "<div class='products'>";
            while ($prod = $prod_result->fetch_assoc()) {
                echo "
                    <div class='product-card'>
                        <img src='images/{$prod['image']}' alt='{$prod['name']}'>
                        <div class='product-details'>
                            <strong>{$prod['name']}</strong>
                            <p>{$prod['description']}</p>
                            <div class='price'>Rs. {$prod['price']}</div>
                        </div>
                    </div>
                ";
            }
            echo "</div>";
        } else {
            echo "<p>No products found in this category.</p>";
        }
    }
} else {
    echo "<p>No categories available.</p>";
}

$conn->close();

echo "</body></html>";
?>
