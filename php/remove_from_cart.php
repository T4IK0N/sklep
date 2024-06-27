<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$index = $data['index'];

// Remove the product from the cart session
if (isset($_SESSION['cart'][$index])) {
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);