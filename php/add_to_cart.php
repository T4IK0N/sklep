<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

$productImage = $data['image'];
$productName = $data['name'];
$productPrice = $data['price'];

// Add product to the cart session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$found = false;

foreach ($_SESSION['cart'] as &$item) {
    if ($item['name'] === $productName) {
        $item['quantity']++;
        $found = true;
        break;
    }
}

if (!$found) {
    $_SESSION['cart'][] = [
        'image' => $productImage,
        'name' => $productName,
        'unitPrice' => $productPrice,
        'quantity' => 1,
    ];
}

echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);