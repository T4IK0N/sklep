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
    <link rel="stylesheet" href="style/regulamin.css">
    <script src="scripts/common.js" defer></script>
    <script src="scripts/regulamin.js" defer></script>
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

<section class="padding-sec">
    <main>
        <h1 id="title-subpage" class="font-poppins">
            REGULAMIN
        </h1>
        <section id="hero-subpage">
            <p>
                <b>§2 POSTANOWIENIA WSTĘPNE</b><br>
                1. Sklep internetowy mysticmarket.com. prowadzony jest przez „Mystic Ventures” Piotr Nowak zarejestrowaną w Gliwicach na ulicy Leśnej 8/154, 44-100, a wpisaną/wpisanego do Centralnej Ewidencji i Informacji o Działalności Gospodarczej prowadzonej przez Ministra Gospodarki, nr NIP 1234567890, REGON 987654321. Niniejszy regulamin stanowi zasady zawierania umów sprzedaży zawieranych na odległość za pośrednictwem Sklepu.
            </p>
            <p>
                <b>§2 DEFINICJE</b><br>
            
                1. Konsument – Użytkownik będący osobą fizyczną dokonującą z Przedsiębiorcą w ramach sklepu mysticmarket czynności prawnej niezwiązanej bezpośrednio z jego działalnością gospodarczą lub zawodową.
                <br>2. Przedsiębiorca – „Mystic Ventures” Piotr Nowak z siedzibą: ul. Leśna 8/154, 44-100 Gliwice wpisaną/wpisanego do Centralnej Ewidencji i Informacji o Działalności Gospodarczej prowadzonej przez Ministra Gospodarki, nr NIP 1234567890.
                <br>3. Użytkownik – każdy podmiot dokonujący zakupów za pośrednictwem Sklepu.
                <br>4. Sklep – sklep internetowy prowadzony przez Przedsiębiorcę pod adresem www.mysticmarket.com.
            </p>
            <p>
                <b>§ 3 KONTAKT</b><br>
            
                1. Adres przedsiębiorstwa: „Mystic Ventures” Piotr Nowak ul. Leśna 8/154, Gliwice 44-100.
                <br>2. Adres poczty elektronicznej: sklep@mysticmarket.com.
                <br>3. Telefon kontaktowy: +48 123 456 789.
                <br>4. Konsument może porozumieć się z Przedsiębiorcą za pośrednictwem adresów i danych podanych w niniejszym paragrafie.
            </p>
            <p>
                <b>§ 4 INFORMACJE WSTĘPNE</b>
            
                <br>1. Ceny podane w Sklepie są podane w polskich złotych.
                <br>2. Na ostateczna cenę zamówienia składa się cena za towar oraz koszt dostawy wskazane na stronach Sklepu.
            </p>
            <p>
                <b>§ 5 WYKONANIE UMOWY SPRZEDAŻY</b>
            
                <br>1. Użytkownik powinien zapłacić Przedsiębiorcy za zakupiony towar w terminie 7 dni.
                <br>2. Użytkownik może skorzystać m.in. z następujących form płatności:
                <br>a. przelew tradycyjny
                <br>b. za pośrednictwem serwisu PayU. Obsługą płatności elektronicznych zajmuje się operator PayU Spółka Akcyjna 60-166 Poznań, ul. Grunwaldzka 186
                <br>NIP: 789-45-67-123.
            </p>
            <p>
                Dostępne formy płatności:
            </p>
            <p>
                Karty płatnicze: Visa, Visa Electron, MasterCard, MasterCard Electronic, Maestro,
                <br>Płatności online,
                <br>Płatności mobile BLIK,
                <br>Płatności Google Pay.
                <br>W przypadku wystąpienia konieczności zwrotu środków za transakcję dokonaną przez klienta kartą płatniczą sprzedający dokonana zwrotu na rachunek bankowy przypisany do karty płatniczej Zamawiającego. W przypadku płatności kartą termin dostawy towaru lub usługi liczy się od momentu pozytywnej autoryzacji transakcji.
            
                <br>3. Szczegółowe informacje dotyczące akceptowanych metod płatności znajdują się na stronach Sklepu.
                <br>4. Towar zostanie wysłany przez Przedsiębiorcę w terminie wskazanym w opisie towaru, w sposób wybrany przez Konsumenta podczas składania zamówienia.
                <br>5. Dostawa towaru odbywa się wyłącznie na terenie Polski.
            </p>
            <p>
                <b>§ 6 PRAWO ODSTĄPIENIA OD UMOWY</b><br>
            
                1. Konsument ma prawo odstąpić od umowy w terminie 14 dni bez podania jakiejkolwiek przyczyny.
                <br>2. Termin do odstąpienia od umowy wygasa po upływie 14 dni od dnia w którym Konsument wszedł w posiadanie rzeczy lub w którym osoba trzecia inna niż przewoźnik i wskazana przez Konsumenta weszła w posiadanie rzeczy.
                <br>3. Aby skorzystać z prawa odstąpienia od umowy, Konsument musi poinformować Przedsiębiorcę o swojej decyzji o odstąpieniu od umowy w drodze jednoznacznego oświadczenia – korzystając z danych Przedsiębiorcy podanych w niniejszym regulaminie.
                <br>4. Konsument może skorzystać z wzoru formularza odstąpienia od umowy zamieszczonego w Internecie, jednak nie jest to obowiązkowe.
                <br>5. Aby zachować termin do odstąpienia od umowy, wystarczy, aby Konsument wysłał informację dotyczącą wykonania przysługującego prawa odstąpienia od umowy przed upływem terminu do odstąpienia od umowy.
                <br>6. Skutki odstąpienia od umowy:
                <br>a. w przypadku odstąpienia od umowy Przedsiębiorca zwraca Konsumentowi wszystkie otrzymane od Konsumenta płatności, w tym koszty dostarczenia rzeczy (z wyjątkiem: dodatkowych kosztów wynikających z wybranego przez Konsumenta sposobu dostarczenia innego niż najtańszy zwykły sposób dostarczenia oferowany przez Przedsiębiorcę w Sklepie), niezwłocznie, a w każdym przypadku nie później niż 7 dni od dnia, w którym Przedsiębiorca został poinformowany o decyzji Konsumenta o wykonaniu prawa odstąpienia od umowy;
                <br>b. zwrotu płatności Przedsiębiorca dokona przy użyciu takich samych sposobów płatności, jakie zostały przez Konsumenta użyte w pierwotnej transakcji, chyba że Konsument wyraźnie zgodził się na inne rozwiązanie; w każdym przypadku Konsument nie poniesie żadnych opłat w związku z tym zwrotem;
                <br>c. Przedsiębiorca może wstrzymać się ze zwrotem płatności do czasu otrzymania towaru lub do czasu dostarczenia mu dowodu jego odesłania, w zależności od tego, które zdarzenie nastąpi wcześniej;
                <br>d. Konsument powinien odesłać towar na adres Przedsiębiorcy podany w niniejszym regulaminie niezwłocznie, a w każdym razie nie później niż 14 dni od dnia, w którym poinformował Przedsiębiorcę o odstąpieniu od umowy. Termin zostanie zachowany, jeżeli Konsument odeśle towar przed upływem terminu 14 dni;
                <br>e. Konsument ponosi bezpośrednie koszty zwrotu rzeczy;
                <br>f. Konsument odpowiada tylko za zmniejszenie wartości rzeczy wynikające z korzystania z niej w sposób inny niż było to konieczne do stwierdzenia charakteru, cech i funkcjonowania rzeczy.
                <br>7. W przypadku gdy ze względu na swój charakter rzeczy nie mogą zostać w zwykłym trybie odesłane pocztą informacja o tym, a także o kosztach zwrotu rzeczy, będzie się znajdować w opisie rzeczy w Sklepie.
                <br>8. Prawo odstąpienia od umowy zawartej na odległość, przysługuje klientom przy zakupie produktów z kategorii: CD, Vinyl, Odzież, książki, preoder oraz Mystic Ventures, z wyłączeniem produktów, które, zgodnie z Art. 38 ustawy o prawach konsumenta są nieprefabrykowane, wyprodukowane według specyfikacji konsumenta lub służące zaspokojeniu jego zindywidualizowanych potrzeb.
            </p>
            <p>
                <b>§ 7 REKLAMACJA i GWARANCJA</b>
            
                <br>1. Przedsiębiorca jest zobowiązany do dostarczenia rzeczy wolnej od wad.
                <br>2. W przypadku wystąpienia wady zakupionego u Przedsiębiorcy towaru Konsument ma prawo do reklamacji w oparciu o rękojmię uregulowaną przepisami kodeksu cywilnego.
                <br>3. Reklamację należy zgłosić pisemnie lub drogą elektroniczną na podane w niniejszym regulaminie adresy Przedsiębiorcy.
                <br>4. Zaleca się aby w reklamacji zawrzeć m.in. zwięzły opis wady, datę jej wystąpienia, dane Konsumenta składającego reklamację oraz żądanie Konsumenta w związku z wadą towaru.
                <br>5. Przedsiębiorca ustosunkuje się do żądania reklamacyjnego Konsumenta w terminie 14 dni, a jeśli nie zrobi tego w tym terminie uważa się, że żądanie Konsumenta uznał za uzasadnione.
                <br>6. W przypadku zakupu towaru przez przedsiębiorcę jako niezwiązanego z jego działalnością gospodarczą przysługują mu te same prawa do zwrotu lub reklamacji jak w przypadku pozostałych Konsumentów. Kupujący przedsiębiorca ma prawo skorzystać z prawa rękojmi do 2 lat od kupna towaru.
                <br>7. Towary odsyłane w ramach procedury reklamacyjnej należy wysyłać na adres podany w § 3 Regulaminu. 7. W przypadku gdy na produkt została udzielona gwarancja informacja o niej, a także jej treść, będą zawarte przy opisie produktu w Sklepie.
            </p>
            <p>
                <b>§ 8 POZASĄDOWE SPOSOBY ROZPATRYWANIA REKLAMACJI i DOCHODZENIA ROSZCZEŃ</b>
            
                <br>1. Konsument ma możliwość skorzystania m.in. z:
                a. mediacji prowadzonej przez Wojewódzkie Inspektoraty Inspekcji Handlowej.
                b. pomocy stałych polubownych sądów konsumenckich działających przy Wojewódzkich Inspektoratach Inspekcji Handlowej.
            </p>
            <p>
                <b>§ 9 DANE OSOBOWE</b>
            
                <br>1. Użytkownik dokonując zakupów w Sklepie dobrowolnie podaje swoje dane, które są konieczne dla zrealizowania zamówienia i będą w tym celu przetwarzane przez Przedsiębiorcę.
                <br>2. Dane osobowe Użytkownika przetwarzane są głównie na podstawie umowy i w celu jej realizacji, zgodnie z zasadami określonymi w ogólnym rozporządzeniu Parlamentu Europejskiego i Rady (EU) o ochronie danych (RODO). Szczegółowe informacje dotyczące przetwarzania danych przez Przedsiębiorcę zawiera polityka prywatności zamieszczona w Sklepie.
            </p>
            <p>
                <b>§ 10 POSTANOWIENIA KOŃCOWE</b>
            
                <br>1. W kwestiach nieuregulowanych w niniejszym regulaminie mają zastosowanie powszechnie obowiązujące przepisy prawa polskiego, w szczególności: ustawa o prawach konsumenta z dnia 30 maja 2014 r., ustawa kodeks cywilny z dnia 23 kwietnia 1964 r. oraz ustawa kodeks postępowania cywilnego z dnia 17 listopada 1964 r.
                <br>2. Umowa sprzedaży zawierana w oparciu o niniejszy regulamin dotyczy konkretnego zamówienia i jest zawierana w celu realizacji jednorazowego zamówienia. Każde zamówienie wymaga osobnej akceptacji regulaminu.
            </p>
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

</body>
</html>