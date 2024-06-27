<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "shop";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/common.css">
    <link rel="stylesheet" href="style/index.css">
    <script src="scripts/common.js" defer></script>
    <script src="scripts/index.js" defer></script>
    <title>Strona internetowa</title>
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

    <div class="hero-bg">
        <img src="img/hero.jpg" alt=""/>
    </div>

    <section class="padding-sec">
        <main>
            <section id="hero">
                <div class="hero-container" id="hero-container">
                    <div class="hero-title font-bayon">
                        <h1>NAJLEPSZE</h1>
                        <h1>OKAZJE</h1>
                        <h3>SPECJALNIE DLA CIEBIE</h3>
                    </div>
                    <div class="hero-content" id="hero-content-main">
                        <div class="hero-product">
                            <a href="produkt.php?id=<?php $specialProductId = 3; echo $specialProductId; ?>">
                                <img src="img/<?php
                                $sql = "SELECT products.id, products.shortName, products.price, productimages.image 
                                               FROM products
                                               LEFT JOIN productimages ON products.id = productimages.productId 
                                               WHERE products.id = ?";
                                $stmt = $conn->prepare($sql);

                                $stmt->bind_param("i", $specialProductId);

                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    $specialProduct = $result->fetch_assoc();
                                } else {
                                    $errorMsg = 'Special product not found';
                                    $stmt->close();
                                    $conn->close();


                                    header("Location: php/error.php?errorMsg=" . urlencode($errorMsg));
                                    exit();
                                }

                                $stmt->close();

                                echo $specialProduct['image']; ?>" alt="<?php echo $specialProduct['shortName'];
                                ?>"/>
                            </a>
                            <div class="hero-product-container">
                                <div>
                                    <span><strong><?php echo $specialProduct['shortName']; ?></strong></span>
                                    <p>Tylko teraz przesyłka za darmo!</p>
                                </div>
                                <button id="product-cart-btn-special" onclick="addToCart('<?php echo $specialProduct['id']; ?>', '<?php echo $specialProduct['image']; ?>', '<?php echo $specialProduct['shortName']; ?>', <?php echo $specialProduct['price']; ?>)">DODAJ DO KOSZYKA</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="products">
                <h1 class="crooked font-bayon new-products">NOWE OFERTY</h1>
                <div class="product-list">
                    <?php
                    $sql = "SELECT products.id, products.shortName, products.price, (SELECT productimages.image FROM productimages WHERE productimages.productId = products.id LIMIT 1) AS image FROM products INNER JOIN newproducts ON newproducts.productId = products.id WHERE products.id != ? LIMIT 6";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $specialProductId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $counter = 0;
                        while($row = $result->fetch_assoc()) {
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
                            $counter++;
                            if ($counter >= 6) {
                                break;
                            }
                        }
                    } else {
                        echo "0 results";
                    }

                    $stmt->close();
                    ?>
                </div>
                <h1 class="crooked font-bayon new-products">POLECANE</h1>
                <div class="product-list">
                    <?php
                    $sql = "SELECT products.id, products.shortName, products.price, (SELECT productimages.image FROM productimages WHERE productimages.productId = products.id LIMIT 1) AS image FROM products INNER JOIN recommendedproducts ON recommendedproducts.productId = products.id WHERE products.id != ? LIMIT 6";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $specialProductId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $counter = 0;
                        while($row = $result->fetch_assoc()) {
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
                            $counter++;
                            if ($counter >= 6) {
                                break;
                            }
                        }
                    } else {
                        echo "0 results";
                    }

                    $stmt->close();
                    ?>
                </div>
                <a href="wyszukiwarka.php" class="search-anchor">
                    <strong>Zobacz wszystkie produkty</strong>
                </a>
            </section>
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

    <!-- Hero content second -->
    <div class="hero-content" id="hero-content-second">
        <div class="hero-product">
            <img src="img/<?php echo $specialProduct['image']; ?>" alt="<?php echo $specialProduct['shortName']; ?>"/>
            <div class="hero-product-container">
                <div>
                    <span><strong><?php echo $specialProduct['shortName']; ?></strong></span>
                    <p>Tylko teraz przesyłka za darmo!</p>
                </div>
                <button id="product-cart-btn-special" onclick="addToCart('<?php echo $specialProduct['id']; ?>', '<?php echo $specialProduct['image']; ?>', '<?php echo $specialProduct['shortName']; ?>', <?php echo $specialProduct['price']; ?>)">DODAJ DO KOSZYKA</button>
            </div>
        </div>
    </div>

</body>
</html>

<?php
$conn->close();
?>