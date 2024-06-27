<?php

session_start();

$input = json_decode(file_get_contents('php://input'), true);

$productID = $input['id'];
$productImage = $input['image'];
$productName = $input['name'];
$productPrice = $input['price'];

$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['name'] === $productName) {
        $item['id'] = $productID;
        $item['quantity'] += 1;
        $item['price'] += $productPrice;
        $found = true;
        break;
    }
}

if (!$found) {
    $_SESSION['cart'][] = [
        'id' => $productID,
        'image' => $productImage,
        'name' => $productName,
        'price' => $productPrice,
        'unitPrice' => $productPrice,
        'quantity' => 1
    ];
}

echo json_encode(['status' => 'success']);