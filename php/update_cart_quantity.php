<?php
session_start();
$input = json_decode(file_get_contents('php://input'), true);

$index = $input['index'];
$value = $input['value'];

if (isset($_SESSION['cart'][$index]) && is_numeric($value) && $value >= 1) {
    $_SESSION['cart'][$index]['quantity'] = (int)$value;
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid quantity or index']);
}
