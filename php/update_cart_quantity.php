<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$index = $data['index'];
$quantity = $data['quantity'];

if (isset($_SESSION['cart'][$index])) {
    $_SESSION['cart'][$index]['quantity'] = (int)$quantity;
}

echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);