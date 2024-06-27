<?php

session_start();
$input = json_decode(file_get_contents('php://input'), true);

$index = $input['index'];

if (isset($_SESSION['cart'][$index])) {
    array_splice($_SESSION['cart'], $index, 1);
}

echo json_encode(['status' => 'success']);