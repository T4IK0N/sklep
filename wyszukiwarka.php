<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
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
                    <div class="select-div">
                        <div class="dropbtn">Kategorie</div>
                        <!-- dropdown options below -->
                    </div>
                    <div class="select-icon-div">
                        <img src="icons/sort_down.png" class="select-icon" alt="">
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
                    <a href="wyszukiwarka.php" class="search-button-media">
                        <img src="icons/search-media.png" class="search-icon-media" alt=""/>
                    </a>
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
        <div class="dropdown-content" id="dropdown-content">
            <a href="#">Opcja 1</a>
            <a href="#">Opcja 2</a>
            <a href="#">Opcja 3</a>
        </div>
    </nav>
</section>

<hr class="whiteLine">

<section class="padding-sec">
    <main class="vertical-padding">
        <h1 class="font-bayon">ZNALEZIONO 99 OFERT</h1>
        <div class="vertical-padding product-list">
            <?php
            // Konfiguracja bazy danych
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shop";

            // Tworzenie połączenia
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Sprawdzanie połączenia
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Zapytanie SQL
            $sql = "SELECT products.id, products.fullName, products.price, productimages.image FROM products LEFT JOIN productimages ON products.id = productimages.productId";
            $result = $conn->query($sql);

            // Generowanie HTML
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                        <div class="product">
                            <a class="product-anchor" href="product.html?id=' . $row["id"] . '">
                                <div class="product-top-half">
                                    <img src="img/' . $row["image"] . '" alt="' . $row["fullName"] . '" class="product-img"/>
                                </div>
                            </a>
                            <div class="product-bottom-half">
                                <div class="product-description">
                                    <span>' . $row["fullName"] . '</span>
                                    <span>
                                        <strong>' . number_format($row["price"], 2, ',', '') . 'zł</strong>
                                    </span>
                                </div>
                                <div class="product-cart">
                                    <button class="product-cart-btn" onclick="addToCart(\'' . $row["fullName"] . '\', ' . $row["price"] . ')">
                                        <img src="icons/bag.png" class="product-cart-icon">
                                    </button>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo "0 results";
            }

            // Zamknięcie połączenia
            $conn->close();
            ?>
        </div>
        <div class="page-selector">
            <a href="#"><<</a>
            <a href="#">
                <strong>
                    <u>1</u>
                </strong>
            </a>
            <a href="#">>></a>
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

<!-- Search Mod HTML -->
</body>
</html>