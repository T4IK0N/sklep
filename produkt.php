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
    <link rel="stylesheet" href="style/produkt.css">
    <script src="scripts/common.js" defer></script>
    <script src="scripts/produkt.js" defer></script>
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
        <div class="product-information">
            <div class="product-information-left">
                <img class="main-image" src="img/product.jpg" />
                <div class="product-variations flex-row">
                    <img src="img/product.jpg" />
                    <img src="img/product.jpg" />
                    <img src="img/product.jpg" />
                </div>
            </div>
            <div class="product-information-right">
                <div class="product-information-divider">
                    <h1 class="product-title">Żelazko TEFAL Easygliss</h1>
                </div>
                <div class="product-information-divider">
                    <div class="description">
                        <div class="description-part">
                            <h3 class="font-bayon">Opis produktu</h3>
                            <p>Mmm żelazko pyuszne mnianm  mniamn</p>
                        </div>
                        <div class="description-part">
                            <h3 class="font-bayon">Specyfikacja</h3>
                            <p>Rodzaj: AGD <br> Kolor: czarny</p>
                        </div>
                    </div>
                </div>
                <div class="product-information-divider" id="price-div">
                    <span id="price">499,99 zł</span>
                    <div class="add-to-cart flex-row">
                        <input type="number" id="product-count" min="1" max="10" value="1"/>
                        <label for="product-count">
                            <button class="gray-bg" id="add-product" onclick="addToCart('Żelazko TEFAL Easygliss', 499.99)">DODAJ DO KOSZYKA</button>
                        </label>
                    </div>
                </div>
            </div>
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