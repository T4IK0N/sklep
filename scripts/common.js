let zmienna = 0;



// SEARCHING IN NAVBAR

const searchInput = document.querySelector('.search-input');
const categoryDropdown = document.querySelector('.dropbtn');
const searchButton = document.querySelector('.search-button');
let selectedCategory = '';

function loadCategories() {
    fetch('php/load_categories.php')
        .then(response => response.json())
        .then(data => {
            const dropdownContent = document.getElementById('dropdown-content');
            dropdownContent.innerHTML = '';
            data.categories.forEach(category => {
                const option = document.createElement('a');
                option.classList.add('dropdown-anchor');
                option.textContent = category.name;
                option.dataset.id = category.id;
                option.addEventListener('click', () => {
                    categoryDropdown.textContent = category.name;
                    selectedCategory = category.name;
                });
                dropdownContent.appendChild(option);
            });
            setMenuPosition();
        });
}

function performSearch(navigate = false) {
    const query = searchInput.value;
    const category = selectedCategory || '';

    // changeFormFilter(query, category);

    if (navigate && category === '') {
        window.location.href = `wyszukiwarka.php?query=${query}`;
    } else if (navigate && query === '') {
        window.location.href = `wyszukiwarka.php?category=${category}`;
    } else if (navigate && query !== '' && category !== '') {
        window.location.href = `wyszukiwarka.php?query=${query}&category=${category}`;
    } else if (navigate && query === '' && category === '') {
        window.location.href = `wyszukiwarka.php`;
    }
}

searchInput.addEventListener('input', function () {
    performSearch();
});


searchInput.addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        performSearch(true);
    }
});

categoryDropdown.addEventListener('click', function () {
    loadCategories();
});

searchButton.addEventListener('click', function (event) {
    event.preventDefault();
    performSearch(true);
});

// MODAL

function addToCart(productID, productImage, productName, productPrice) {
    const data = {id: productID, image: productImage, name: productName, price: productPrice};

    fetch('php/add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(data => {
            updateCartIcon();
            updateCartItems();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

function updateCartIcon() {
    fetch('php/fetch_cart.php')
        .then(response => response.json())
        .then(cart => {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.querySelector('.cart-icon-container p').textContent = `Koszyk (${totalItems})`;
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

function cart_function() {
    showModal();
    updateCartItems();
}

function showModal() {
    const modal = document.getElementById('cart-modal');
    const cartIcon = document.getElementById('cart-icon-container');

    const rect = cartIcon.getBoundingClientRect();

    modal.style.top = `${rect.bottom + window.scrollY}px`;
    modal.style.left = `${rect.left + window.scrollX}px`;
    modal.style.display = "block";
}

function updateCartItems() {
    fetch('php/fetch_cart.php')
        .then(response => response.json())
        .then(cart => {
            const cartItemsContainer = document.getElementById('cart-items');
            cartItemsContainer.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                const itemElement = document.createElement('div');
                itemElement.classList.add('cart-item');

                if (item.unitPrice !== null) {
                    const itemElement2 = document.createElement('div');
                    itemElement2.classList.add('cart-item-left');

                    const itemElement3 = document.createElement('a');
                    itemElement3.href = `produkt.php?id=${item.id}`;
                    itemElement3.classList.add('cart-item-image');
                    itemElement3.innerHTML = `
                    <img src="img/${item.image}" alt="product-from-fetch">
                `;

                    const itemElement4 = document.createElement('div');
                    itemElement4.classList.add('cart-item-nameAndPrice');
                    itemElement4.innerHTML = `
                    <span class="cart-item-name">${item.name}</span>
                    <span class="cart-item-price">${item.quantity} x ${item.unitPrice.toFixed(2)} zł</span>
                `;

                    const itemRemoveElement = document.createElement('div');
                    itemRemoveElement.classList.add('cart-item-remove');
                    itemRemoveElement.innerHTML = `
                    <button class="btn-remove" onclick="removeFromCart(${index})">
                        <span class="material-symbols-light--close remove-icon"></span>
                    </button>
                `;

                    itemElement.appendChild(itemElement2);
                    itemElement.appendChild(itemRemoveElement);

                    itemElement2.appendChild(itemElement3);
                    itemElement2.appendChild(itemElement4);

                    cartItemsContainer.appendChild(itemElement);
                    total += item.quantity * item.unitPrice;
                }
            });

            document.getElementById('cart-total').textContent = `${total.toFixed(2)} zł`;

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = '<div id="empty-cart-message">Koszyk jest pusty</div>';
                document.getElementById('cart-total').textContent = '0.00 zł';
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}


function removeFromCart(index) {
    fetch('php/remove_from_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({index: index}),
    })
        .then(response => response.json())
        .then(data => {
            updateCartIcon();
            updateCartItems();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}


function redirectToSubpage(relativeUrl) {
    window.location.href = relativeUrl;
}

function placeOrder() {
    closeModal();
    updateCartIcon();
    redirectToSubpage('koszyk.php');
}


function closeModal() {
    const modal = document.getElementById('cart-modal');
    if (modal.style.display !== "none") {
        modal.style.display = "none";
    }
}

closeModal();
updateCartIcon();

// RESPONSIVE PADDING

function changeHorizontalPadding() {
    let innerWidth = 1300;
    const windowWidth = window.innerWidth;
    const calc = (windowWidth - innerWidth) / 2;
    const newHorizontalPadding = `${calc}px`;
    document.documentElement.style.setProperty('--horizontal-padding', newHorizontalPadding);

    if (calc <= 0) {
        const calc2 = (windowWidth - innerWidth) / 2 + 150;
        const newHorizontalPadding = `${calc2}px`;

        document.documentElement.style.setProperty('--horizontal-padding', newHorizontalPadding);
        if (calc2 <= 0) {
            const calc3 = (windowWidth - innerWidth) / 2 + 275;
            const newHorizontalPadding = `${calc3}px`;

            document.documentElement.style.setProperty('--horizontal-padding', newHorizontalPadding);

            if (calc3 <= 0) {
                const calc4 = (windowWidth - innerWidth) / 2 + 350;
                const newHorizontalPadding = `${calc4}px`;

                document.documentElement.style.setProperty('--horizontal-padding', newHorizontalPadding);

                if (calc4 <= 0) {
                    const newHorizontalPadding = '4dvw';

                    document.documentElement.style.setProperty('--horizontal-padding', newHorizontalPadding);
                }
            }
        }
    }
}

// THIS FUNC IS VERY USEFUL AND HAVE TO BE OVERWRITE IN OTHER FIELS

function closeModalOnClickOutside(event) {
    const modal = document.getElementById('cart-modal');
    const cartIcon = document.getElementById('cart-icon-container');
    // const buttons = Array.from(document.getElementsByClassName('product-cart-btn'));
    // const buttonSpecial = document.getElementById('product-cart-btn-special');
    // const removeButtons = Array.from(document.getElementsByClassName('cart-item-remove'));
    // const isButtonClick = buttons.some(button => button.contains(event.target));
    // const isButtonRemoveClick = removeButtons.some(button => button.contains(event.target));

    // console.log('Clicked element:', event.target);
    // console.log('isButtonClick:', isButtonClick);
    // console.log('isButtonRemoveClick:', isButtonRemoveClick);

    if (modal.style.display !== "none" &&
        !modal.contains(event.target) &&
        !cartIcon.contains(event.target)) {
        // console.log('zamknalem modal z funkcji closeModalOnOutside');
        closeModal();
    }
}

// POSITION MODAL

function setModulePosition() {
    const modal = document.getElementById('cart-modal');
    const cart = document.getElementById('cart-icon-container').getBoundingClientRect();
    const cartWidth = document.getElementById('cart-icon-container').clientWidth;
    const windowWidth = window.innerWidth;

    if (windowWidth <= 800) {
        const leftPosition = (cart.left - 1.5 * cartWidth);
        const topPosition = 60;

        modal.style.left = `${leftPosition}px`;
        modal.style.top = `${topPosition}px`;
    } else {
        const leftPosition = (cart.left);
        const topPosition = 60;

        modal.style.left = `${leftPosition}px`;
        modal.style.top = `${topPosition}px`;
    }
}

// POSITION OF SEARCH

function setMenuPosition() {
    const menu = document.getElementById('dropdown-content');
    const menuWidth = menu.clientWidth;
    const drop = document.getElementById('dropdown').getBoundingClientRect();

    const leftPosition = drop.right - menuWidth;
    const topPosition = (drop.bottom + 1);

    menu.style.left = `${leftPosition}px`;
    menu.style.top = `${topPosition}px`;
}

// SHOW PRODUCTS MENU

function closeMenu() {
    const dropdownContent = document.getElementById('dropdown-content');
    if (dropdownContent.style.display !== "none") {
        dropdownContent.style.display = "none";
    }
}

function closeMenuOnClickOutside(event) {
    const dropdown = document.getElementById('dropdown');

    if (dropdown.style.display !== "none" &&
        !dropdown.contains(event.target)) {
        closeMenu();
    }
}

document.querySelector('#dropdown').addEventListener('click', function () {
    const dropdownContent = document.getElementById('dropdown-content');
    dropdownContent.style.display = "block";
});


// SHOW SEARCH-MOD

function showSearch() {
    const navSearch = document.getElementById('nav-search');
    if (navSearch.style.display === "none") {
        navSearch.style.display = "flex";
    }
}

function closeSearch() {
    if (zmienna === 0) {
        const navSearch = document.getElementById('nav-search');
        if (navSearch.style.display !== "none") {
            navSearch.style.display = "none";
        }
    } else {
        console.log('kutas');
    }
}

function closeSearchOnClickOutside(event) {
    const navSearch = document.getElementById('nav-search');
    const searchButton = document.getElementById('search-button-media');
    const dropdownContent = document.getElementById('dropdown-content');

    if (navSearch.style.display !== "none" &&
        !navSearch.contains(event.target) &&
        !searchButton.contains(event.target) &&
        !dropdownContent.contains(event.target)) {
        closeSearch();
    }
}

document.querySelector('#search-button-media').addEventListener('click', function () {
    const navSearch = document.getElementById('nav-search');
    navSearch.style.display = "flex";
});

// ALL EVENTS

document.getElementById('dropdown').addEventListener('click', () => {
    setMenuPosition();
})

window.addEventListener('resize', () => {
    changeHorizontalPadding();
    setMenuPosition();
    setModulePosition();
    // if (window.innerWidth <= 800) {
    //     closeSearch();
    // } else {
    //     showSearch();
    // }
});

document.querySelector('.search-input').addEventListener('focus', () => {
    let zmienna = 1;
})

window.addEventListener('load', () => {
    changeHorizontalPadding();
    setMenuPosition();
    setModulePosition();
    if (window.innerWidth < 800) {
        closeSearch();
    } else {
        showSearch();
    }
});

window.addEventListener('click', (event) => {
    closeModalOnClickOutside(event);
    closeMenuOnClickOutside(event);
    if (window.innerWidth < 800) {
        closeSearchOnClickOutside(event);
    }
});

if (document.getElementById('nav-search-media').style.display !== "none") {
    closeSearch();
}

window.addEventListener('resize', () => {
    if (window.innerWidth <= 800) {
        closeSearch();
    } else {
        showSearch();
    }
})