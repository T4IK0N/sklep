<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM categories";
$stmt = $conn->prepare($sql);

$stmt->execute();

$result = $stmt->get_result();

$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

$stmt->close();

$conn->close();

echo json_encode(['categories' => $categories]);