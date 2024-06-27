<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? $_GET['query'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$categoryFilter = $category ? "AND categories.name = '$category'" : "";

$sql = "SELECT products.id, products.shortName, products.price, (
            SELECT productimages.image 
            FROM productimages 
            WHERE productimages.productId = products.id 
            LIMIT 1
        ) AS image
        FROM products
        JOIN categories ON categories.id = products.categoryId
        WHERE products.shortName LIKE '%$query%' $categoryFilter";

$price_asc = isset($_POST['price_asc']) ? $_POST['price_asc'] : '';
$price_desc = isset($_POST['price_desc']) ? $_POST['price_desc'] : '';
$min_price = isset($_POST['min_price']) ? $_POST['min_price'] : '';
$max_price = isset($_POST['max_price']) ? $_POST['max_price'] : '';

$limit = 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if ($min_price) {
    $sql .= " AND price >= $min_price";
}
if ($max_price) {
    $sql .= " AND price <= $max_price";
}

$totalResult = $conn->query($sql);
$totalProducts = $totalResult->num_rows;

if ($totalProducts === 1) {
    $foundWord = 'OFERTE';
} else if ($totalProducts >= 2 && $totalProducts <= 4) {
    $foundWord = 'OFERTY';
} else {
    $foundWord = 'OFERT';
}

$totalPages = ceil($totalProducts / $limit);

if ($price_asc) {
    $sql .= " ORDER BY price ASC";
}

if ($price_desc) {
    $sql .= " ORDER BY price DESC";
}

$sql .= " LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    echo json_encode(['products' => $products, 'totalPages' => $totalPages, 'currentPage' => $page, 'totalProducts' => $totalProducts]);
    $conn->close();
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/common.css">
    <link rel="stylesheet" href="style/wyszukiwarka.css">
    <script src="scripts/common.js" defer></script>
    <script src="scripts/wyszukiwarka.js" defer></script>
    <title>Wyszukaj</title>
</head>
<body>
<section class="padding-sec">
    <nav>
        <div class="nav-div">
            <div class="nav-item nav-logo">
                <a href="index.php">
                    <img src="icons/logo.png" class="logo" id="logo"/>
                </a>
            </div>
            <div class="nav-item nav-search" id="nav-search">
                <input type="text" class="search-input font-poppins" placeholder="Szukaj tutaj...">
                <div class="dropdown" id="dropdown" onclick="setMenuPosition()">
                    <div class="dropbtn">
                        <div class="select-div">
                            <div>Kategorie</div>
                            <!-- dropdown options below -->
                        </div>
                        <div class="select-icon-div">
                            <img src="icons/sort_down.png" class="select-icon" alt="">
                        </div>
                    </div>
                </div>
                <div class="search-icon-div">
                    <a href="wyszukiwarka.php" class="search-button">
                        <img src="icons/search.png" class="search-icon" alt=""/>
                    </a>
                </div>
            </div>

            <!-- second nav-search (only icon) -->
            <div class="nav-item nav-search-media" id="nav-search-media">
                <div class="search-icon-div-media">
                    <div id="search-button-media">
                        <img src="icons/search-media.png" class="search-icon-media"/>
                    </div>
                </div>
            </div>

            <div class="nav-item nav-cart">
                <div id="cart-icon-container" onclick="cart_function(); setModulePosition()" class="cart-icon-container">
                    <img src="icons/cart.png" class="cart-icon" alt=""/>
                    <p class="cart-text">Koszyk (0)</p>
                </div>
            </div>
        </div>
        <!-- dropdown options -->
        <div class="dropdown-content" id="dropdown-content"></div>
    </nav>
</section>

<hr class="whiteLine">

<section class="padding-sec">
    <main class="vertical-padding">
        <div id="search-top">
            <h1 class="font-bayon" id="offer-found">
            <!-- ZNALEZIONO X OFERT -->
                <?php echo 'ZNALEZIONO ' . $totalProducts . ' ' . $foundWord?>
            </h1>
            <div id="filter-div">
                <img src="icons/filter.png" alt="filters" id="filter-icon" />
                <p id="filter-text">Filtry</p>
            </div>
        </div>
        <!-- Filter Mod -->
        <form method="POST" action="<?php
            $query = isset($_GET['query']) ? $_GET['query'] : '';
            $category = isset($_GET['category']) ? $_GET['category'] : '';

            if ($category == '') {
                $formAction = "wyszukiwarka.php?query=$query";
            } else if ($query == '') {
                $formAction = "wyszukiwarka.php?&category=$category";
            } else if ($query != '' && $category != '') {
                $formAction = "wyszukiwarka.php?query=$query&category=$category";
            } else {
                $formAction = "wyszukiwarka.php";
            }

            echo $formAction
        ?>">
            <div id="filter-mod">

                <!-- -->

                <div class="filter-element" id="filter-sort">
                    <p>Sortuj</p>
                </div>

                <!-- -->

                <div class="filter-element" id="filter-price">
                    <p>Cena</p>
                </div>

                <!-- -->

                <button type="submit">Filtruj</button>
            </div>
            <div class="filter-expand" id="sort-div">
                <div class="sort-labels">
                    <input name="price_asc" type="radio" />
                    <label for="price_asc">Cena rosnąco</label>
                </div>
                <div class="sort-labels">
                    <input name="price_desc" type="radio" />
                    <label for="price_desc">Cena malejąco</label>
                </div>
            </div>
            <div class="filter-expand" id="price-div">
                <div class="expand-price">
                    <label for="min_price" id="label_minPrice" class="label_price">Min</label>
                    <input type="number" min="0" max="10000" name="min_price" id="min_price" class="input_price" placeholder="">
                </div>
                <div class="expand-price">
                    <label for="max_price" id="label_maxPrice" class="label_price">Max</label>
                    <input type="number" min="0" max="10000" name="max_price" id="max_price" class="input_price" placeholder="">
                </div>
            </div>
        </form>

        <div class="vertical-padding product-list" id="product-list">
            <?php
            foreach ($products as $row) {
                echo '
                    <div class="product">
                        <a class="product-anchor" href="produkt.php?id=' . $row["id"] . '">
                            <div class="product-top-half">
                                <div class="product-img-container">
                                    <img src="img/' . $row["image"] . '" alt="' . $row["shortName"] . '" class="product-img"/>
                                </div>
                            </div>
                        </a>
                        <div class="product-bottom-half">
                            <div class="product-description">
                                <span>' . $row["shortName"] . '</span>
                                <span>
                                    <strong>' . number_format($row["price"], 2, ',', '') . ' zł</strong>
                                </span>
                            </div>
                            <div class="product-cart">
                                <button class="product-cart-btn" onclick="addToCart(\'' . $row["id"] . '\', \'' . $row["image"] . '\', \'' . $row["shortName"] . '\', ' . $row["price"] . ')">
                                    <img src="icons/bag.png" class="product-cart-icon">
                                </button>
                            </div>
                        </div>
                    </div>
                ';
            }
            ?>
        </div>
        <div class="page-selector">
            <?php if ($totalPages == 1): ?>
                <a href="?query=<?php echo $query; ?>&category=<?php echo $category; ?>&page=<?php echo "1"; ?>" class="activeProductPage">
                    1
                </a>
            <?php endif; ?>
            <?php if ($totalPages > 1): ?>
                <?php if ($page > 1): ?>
                    <a href="?query=<?php echo $query; ?>&category=<?php echo $category; ?>&page=<?php echo $page - 1; ?>"><<</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?query=<?php echo $query; ?>&category=<?php echo $category; ?>&page=<?php echo $i; ?>"
                        <?php if ($i == $page): ?> class="activeProductPage" <?php endif; ?>>
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
                <?php if ($page < $totalPages): ?>
                    <a href="?query=<?php echo $query; ?>&category=<?php echo $category; ?>&page=<?php echo $page + 1; ?>">>></a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>
</section>


<hr class="whiteLine">

<section id="padding-sec-footer">
    <section class="padding-sec">
        <footer>
            <div class="footer-div">
                <div class="footer-logo">
                    <a href="index.php">
                        <img src="icons/logo.png" class="logo" alt=""/>
                    </a>
                </div>
                <div class="footer-content">
                    <div class="footer-content-item">
                        <label for="footer-contact">Kontakt</label>
                        <ul id="footer-contact" class="inter-light-font">
                            <li>
                                <a href="mailto:admin@example.com">admin@example.com</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-content-item">
                        <label for="footer-info">Informacje</label>
                        <ul id="footer-info" class="inter-light-font">
                            <li>
                                <a href="regulamin.php">Regulamin</a>
                            </li>
                            <li>
                                <a href="polityka-prywatnosci.php">Polityka prywatności</a>
                            </li>
                            <li>
                                <a href="dostawa-i-platnosci.php">Dostawa i płatność</a>
                            </li>
                            <li>
                                <a href="zwroty-i-reklamacje.php">Zwroty i reklamacje</a>
                            </li>
                            <li>
                                <a href="kontakt.php">Kontakt</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-content-item">
                        <label for="footer-media">Nasze media</label>
                        <ul id="footer-media" class="inter-light-font">
                            <li>
                                <a href="#">
                                    <img src="icons/instagram.png" class="footer-icons" alt=""/>
                                    <span>Instagram</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="icons/facebook.png" class="footer-icons" alt=""/>
                                    <span>Facebook</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-content-item">
                        <label for="footer-promo">Strona wykonana przez G&G</label>
                        <ul id="footer-promo" class="inter-light-font">
                            <li>
                                <a href="https://ggweb.pl/">
                                    <u>ggweb.pl</u>
                                </a>
                                <a href="#"><img src="icons/whatsapp.png" class="footer-icons" alt=""></a>
                                <a href="#"><img src="icons/instagram.png" class="footer-icons" alt=""></a>
                                <a href="#"><img src="icons/facebook.png" class="footer-icons" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </section>
</section>

<!-- Cart Modal HTML -->
<div id="cart-modal" class="modal">
    <div id="modal-content" class="modal-content">
        <div class="modal-content-div">
            <div id="cart-items" class="cart-items"></div>
        </div>
        <hr class="cartLine">
        <div class="modal-price inter-light-font">
            <p class="cart-total">Kwota</p>
            <p id="cart-total" class="cart-total"></p>
        </div>
        <button onclick="placeOrder()" id="btn-order" class="btn-order">ZAMÓWIENIE</button>
    </div>
</div>

</body>
</html>