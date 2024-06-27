<?php

session_start();
$input = json_decode(file_get_contents('php://input'), true);

$index = $input['index'];

if (isset($_SESSION['cart'][$index])) {
    if ($_SESSION['cart'][$index]['quantity'] > 1) {
        $_SESSION['cart'][$index]['quantity'] -= 1;
        $_SESSION['cart'][$index]['price'] -= $_SESSION['cart'][$index]['unitPrice'];
    } else {
        array_splice($_SESSION['cart'], $index, 1);
    }
}

echo json_encode(['status' => 'success']);