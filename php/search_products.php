<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "shop";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? $_GET['query'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$queryFilter = '%' . $conn->real_escape_string($query) . '%';
$categoryFilter = $category ? $conn->real_escape_string($category) : '';

$sql = "SELECT products.id, products.shortName, products.price, (
            SELECT productimages.image 
            FROM productimages 
            WHERE productimages.productId = products.id 
            LIMIT 1
        ) AS image
        FROM products
        JOIN categories ON categories.id = products.categoryId
        WHERE products.shortName LIKE ?
        " . ($category ? "AND categories.name = ?" : "");

$stmt = $conn->prepare($sql);

if ($category) {
    $stmt->bind_param('ss', $queryFilter, $categoryFilter);
} else {
    $stmt->bind_param('s', $queryFilter);
}

$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode(['products' => $products]);