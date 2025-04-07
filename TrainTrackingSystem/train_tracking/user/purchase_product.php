<?php
require '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die(json_encode(["error" => "❌ Access Denied! Please log in first."]));
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'] ?? '';
$quantity = $_POST['quantity'] ?? '';

if (empty($product_id) || empty($quantity) || $quantity <= 0) {
    die(json_encode(["error" => "❌ Invalid purchase request."]));
}

// Fetch product details
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product || $product['quantity'] < $quantity) {
    die(json_encode(["error" => "❌ Product unavailable or insufficient stock."]));
}

// Reduce product stock
$new_quantity = $product['quantity'] - $quantity;
$stmt = $pdo->prepare("UPDATE products SET quantity = ? WHERE id = ?");
$stmt->execute([$new_quantity, $product_id]);

// Generate invoice
$total_price = $product['price'] * $quantity;
$stmt = $pdo->prepare("INSERT INTO invoices (user_id, product_id, quantity, total_price, purchase_date) VALUES (?, ?, ?, ?, NOW())");
$stmt->execute([$user_id, $product_id, $quantity, $total_price]);

echo json_encode(["message" => "✅ Purchase successful! Invoice generated."]);
?>