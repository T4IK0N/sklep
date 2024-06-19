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
    <link rel="stylesheet" href="style/koszyk.css">
    <script src="scripts/common.js" defer></script>
    <script src="scripts/koszyk.js" defer></script>
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
    <main>
        <section id="cart">
            <div id="cart-products">
                <h3 class="font-bayon title">KOSZYK</h3>
                <div id="product-list">
                    <div class="product-div">
                        <div class="product-div-element product-div-left">
                            <div class="product-image">
                                <img src="img/zelazko_tefal1.jpg">
                            </div>
                            <div class="product-description">
                                <div>
                                    <h3 class="product-title">Żelazko TEFAL Easygliss</h3>
                                    <p>Kolor: Czarny</p>
                                    <span>Ilość: 2</span>
                                </div>
                                <input type="number" min="1" max="10" value="1"/>
                            </div>
                        </div>
                        <div class="product-div-element product-div-right">
                            <div class="delete-div" onclick="deleteProduct()">
                                <img src="icons/close.png" class="delete-img"/>
                            </div>
                            <p>499,99 zł</p>
                        </div>
                    </div>


                    <hr class="grayLine">


                    <div class="product-div">
                        <div class="product-div-element product-div-left">
                            <div class="product-image">
                                <img src="img/lampka_nocna_kall1.jpg">
                            </div>
                            <div class="product-description">
                                <div>
                                    <h3 class="product-title">Żelazko TEFAL Easygliss</h3>
                                    <p>Kolor: Czarny</p>
                                    <span>Ilość: 2</span>
                                </div>
                                <input type="number" min="1" max="10" value="1"/>
                            </div>
                        </div>
                        <div class="product-div-element product-div-right">
                            <div class="delete-div" onclick="deleteProduct()">
                                <img src="icons/close.png" class="delete-img"/>
                            </div>
                            <p>499,99 zł</p>
                        </div>
                    </div>


                    <hr class="grayLine">


                    <div class="product-div">
                        <div class="product-div-element product-div-left">
                            <div class="product-image">
                                <img src="img/zelazko_tefal1.jpg">
                            </div>
                            <div class="product-description">
                                <div>
                                    <h3 class="product-title">Żelazko TEFAL Easygliss</h3>
                                    <p>Kolor: Czarny</p>
                                    <span>Ilość: 2</span>
                                </div>
                                <input type="number" min="1" max="10" value="1"/>
                            </div>
                        </div>
                        <div class="product-div-element product-div-right">
                            <div class="delete-div" onclick="deleteProduct()">
                                <img src="icons/close.png" class="delete-img"/>
                            </div>
                            <p>499,99 zł</p>
                        </div>
                    </div>


                    <hr class="grayLine">


                    <div class="product-div">
                        <div class="product-div-element product-div-left">
                            <div class="product-image">
                                <img src="img/lampka_nocna_kall1.jpg">
                            </div>
                            <div class="product-description">
                                <div>
                                    <h3 class="product-title">Żelazko TEFAL Easygliss</h3>
                                    <p>Kolor: Czarny</p>
                                    <span>Ilość: 2</span>
                                </div>
                                <input type="number" min="1" max="10" value="1"/>
                            </div>
                        </div>
                        <div class="product-div-element product-div-right">
                            <div class="delete-div" onclick="deleteProduct()">
                                <img src="icons/close.png" class="delete-img"/>
                            </div>
                            <p>499,99 zł</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="cart-price">
                <h3 class="font-bayon title">CENA</h3>
                <div class="cart-price-div">
                    <div class="cart-price-div-element">
                        <p>Wartość produktów</p>
                        <p>499,99 zł</p>
                    </div>
                    <div class="cart-price-div-element">
                        <p>Dostawa</p>
                        <p>0,00 zł</p>
                    </div>
                    <hr class="grayLine">
                    <div class="cart-price-div-element final-price">
                        <p>Do zapłaty</p>
                        <p>499,99 zł</p>
                    </div>
                    <button class="gray-bg" id="payment-btn" onclick="paymentAnchor()">PRZEJDŹ DO PŁATNOŚCI</button>
                </div>
            </div>
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

<!-- Search Mod HTML -->
<div id="search-mod">
    <input type="text" class="search-input font-poppins" placeholder="Szukaj tutaj...">
    <div class="dropdown" id="dropdown" onclick="setMenuPosition()">
        <div class="select-icon-div">
            <div class="dropbtn">
                <img src="icons/sort_down.png" class="select-icon">
            </div>
        </div>
    </div>
    <div class="search-icon-div">
        <a href="wyszukiwarka.php" class="search-button">
            <img src="icons/search.png" class="search-icon" alt=""/>
        </a>
    </div>
</div>
</body>
</html>