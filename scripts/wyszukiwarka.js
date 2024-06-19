document.addEventListener("DOMContentLoaded", () => { //DOM

// OVERWRITE FUNCTION closeModalOnClickOutside FROM COMMON.JS

window.closeModalOnClickOutside = function(event) {
    const modal = document.getElementById('cart-modal');
    const cartIcon = document.getElementById('cart-icon-container');
    const buttons = Array.from(document.getElementsByClassName('product-cart-btn'));

    const isButtonClick = buttons.some(button => button.contains(event.target));

    if (modal.style.display !== "none" &&
        !modal.contains(event.target) &&
        !cartIcon.contains(event.target) &&
        !isButtonClick ) {
        // console.log('zamknalem modal z funckji closeModalOnOutsideSearch')
        closeModal();
    }
}

// DROPDOOWN (MENU CATEGORIES) & SEARCHING IN NAVBAR

const searchInput = document.querySelector('.search-input');
const categoryDropdown = document.querySelector('.dropbtn');
const searchButton = document.querySelector('.search-button');
let selectedCategory = '';

searchInput.addEventListener('input', function() {
    performSearch();
});

searchInput.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        performSearch(true);
    }
});

categoryDropdown.addEventListener('click', function() {
    loadCategories();
});

searchButton.addEventListener('click', function(event) {
    event.preventDefault();
    performSearch(true);
});

function loadCategories() {
    fetch('php/load_categories.php')
        .then(response => response.json())
        .then(data => {
            const dropdownContent = document.getElementById('dropdown-content');
            dropdownContent.innerHTML = '';
            data.categories.forEach(category => {
                const option = document.createElement('a');
                option.textContent = category.name;
                option.dataset.id = category.id;
                option.addEventListener('click', () => {
                    categoryDropdown.textContent = category.name;
                    selectedCategory = category.name;
                });
                dropdownContent.appendChild(option);
            });
        });
}

function performSearch(navigate = false) {
    const query = searchInput.value;
    let category = selectedCategory || '';

    if (navigate) {
        window.location.href = `wyszukiwarka.php?query=${query}&category=${category}`;
    } else {
        fetch(`php/search_products.php?query=${query}&category=${category}`)
            .then(response => response.json())
            .then(data => {
                // titleOfSearch();

                const productContainer = document.querySelector('.product-list');
                productContainer.innerHTML = '';
                data.products.forEach(product => {
                    const productDiv = document.createElement('div');
                    productDiv.classList.add('product');
                    productDiv.innerHTML = `
                        <a class="product-anchor" href="produkt.php?id=${product.id}">
                            <div class="product-top-half">
                                <div class="product-img-container">
                                    <img src="img/${product.image}" alt="${product.shortName}" class="product-img"/>
                                </div>
                            </div>
                        </a>
                        <div class="product-bottom-half">
                            <div class="product-description">
                                <span>${product.shortName}</span>
                                <span><strong>${product.price} zł</strong></span>
                            </div>
                            <div class="product-cart">
                                <button class="product-cart-btn" onclick="addToCart('${product.image}', '${product.shortName}', ${product.price})">
                                    <img src="icons/bag.png" class="product-cart-icon">
                                </button>
                            </div>
                        </div>
                    `;
                    productContainer.appendChild(productDiv);
                });
            });
    }
}

// FILTER MOD (ONLY OPTIONS LIKE PRICE, BRAND ETC.)

function closeFilter() {
    const filterMod = document.getElementById('filter-mod');
    if (filterMod.style.display !== "none") {
        filterMod.style.display = "none";
    }
}

function closeFilterOnClickOutside(event) {
    const filterButton = document.getElementById('filter-div');
    const filterMod = document.getElementById('filter-mod');
    const sortDiv = document.getElementById('sort-div');
    const priceDiv = document.getElementById('price-div');
    // const brandDiv = document.getElementById('brand-div');

    if (filterButton.style.display !== "none" &&
        !filterButton.contains(event.target) &&
        !filterMod.contains(event.target) &&
        !sortDiv.contains(event.target) &&
        !priceDiv.contains(event.target)) {
        closeFilter();
    }
}

document.querySelector('#filter-div').addEventListener('click', function () {
    const filterMod = document.getElementById('filter-mod');
    filterMod.style.display = "grid";
});


// EXPAND FILTER (MENU OF FILTERS)

function setPositionFilterExpand(name) {
    const button = document.getElementById(`filter-${name}`);
    const expand = document.getElementById(`${name}-div`);

    const leftPosition = button.getBoundingClientRect().left;
    expand.style.left = `${leftPosition}px`;
}

function expandFilter(name) {
    document.querySelector(`#filter-${name}`).addEventListener('mouseover', function () {
        const expand = document.getElementById(`${name}-div`);
        expand.style.display = "flex";
    });
}
function closeFilterExpandOnClickOutside(event, name) {
    function closeFilterExpand(name) {
        const expandDiv = document.getElementById(`${name}-div`);
        if (expandDiv.style.display !== "none") {
            expandDiv.style.display = "none";
        }
    }

    const filterButton = document.getElementById(`filter-${name}`);
    const filterExpand = document.getElementById(`${name}-div`);

    if (filterButton.style.display !== "none" &&
        !filterButton.contains(event.target) &&
        !filterExpand.contains(event.target)) {
        closeFilterExpand(name);
    }
}
const sort = "sort";
const price = "price";
// const brand = "brand";

window.addEventListener('click', (event) => {
    closeFilterOnClickOutside(event);
    // expandFilter(brand);
    // closeFilterExpandOnClickOutside(event, brand);
});

window.addEventListener('mouseover', (event) => {
    expandFilter(sort);
    expandFilter(price);
    closeFilterExpandOnClickOutside(event, sort);
    closeFilterExpandOnClickOutside(event, price);
})

document.getElementById('filter-div').addEventListener('click', () => {
    setPositionFilterExpand(price)
    // setPositionFilterExpand(brand)
});

window.addEventListener('resize', () => {
    setPositionFilterExpand(price)
    // setPositionFilterExpand(brand)
});


// HOW MANY FOUND PRODUCTS

function titleOfSearch() {
    const productList = document.getElementById('product-list');
    const offerFound = document.getElementById('offer-found');
    let productWord = "";

    if (productList) {
        const productCount = productList.getElementsByClassName('product').length;
        if (productCount === 1) {
            productWord = "OFERTE";
        } else if (productCount >= 2 && productCount <= 4) {
            productWord = "OFERTY";
        } else {
            productWord = "OFERT";
        }

        offerFound.innerHTML = `ZNALEZIONO ${productCount} ${productWord}`;
    }
}

titleOfSearch();
document.addEventListener('keydown', titleOfSearch);
document.addEventListener('keyup', titleOfSearch);


}); // DOM
document.addEventListener("DOMContentLoaded", () => { //DOM

// OVERWRITE FUNCTION closeModalOnClickOutside FROM COMMON.JS

    window.closeModalOnClickOutside = function(event) {
        const modal = document.getElementById('cart-modal');
        const cartIcon = document.getElementById('cart-icon-container');
        const buttons = Array.from(document.getElementsByClassName('product-cart-btn'));

        const isButtonClick = buttons.some(button => button.contains(event.target));

        if (modal.style.display !== "none" &&
            !modal.contains(event.target) &&
            !cartIcon.contains(event.target) &&
            !isButtonClick ) {
            // console.log('zamknalem modal z funckji closeModalOnOutsideSearch')
            closeModal();
        }
    }

// DROPDOOWN (MENU CATEGORIES) & SEARCHING IN NAVBAR

    const searchInput = document.querySelector('.search-input');
    const categoryDropdown = document.querySelector('.dropbtn');
    const searchButton = document.querySelector('.search-button');
    let selectedCategory = '';

    searchInput.addEventListener('input', function() {
        performSearch();
    });

    searchInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            performSearch(true);
        }
    });

    categoryDropdown.addEventListener('click', function() {
        loadCategories();
    });

    searchButton.addEventListener('click', function(event) {
        event.preventDefault();
        performSearch(true);
    });

    function loadCategories() {
        fetch('php/load_categories.php')
            .then(response => response.json())
            .then(data => {
                const dropdownContent = document.getElementById('dropdown-content');
                dropdownContent.innerHTML = '';
                data.categories.forEach(category => {
                    const option = document.createElement('a');
                    option.textContent = category.name;
                    option.dataset.id = category.id;
                    option.addEventListener('click', () => {
                        categoryDropdown.textContent = category.name;
                        selectedCategory = category.name;
                    });
                    dropdownContent.appendChild(option);
                });
            });
    }

    function performSearch(navigate = false) {
        const query = searchInput.value;
        let category = selectedCategory || '';

        if (navigate) {
            window.location.href = `wyszukiwarka.php?query=${query}&category=${category}`;
        } else {
            fetch(`php/search_products.php?query=${query}&category=${category}`)
                .then(response => response.json())
                .then(data => {
                    // titleOfSearch();

                    const productContainer = document.querySelector('.product-list');
                    productContainer.innerHTML = '';
                    data.products.forEach(product => {
                        const productDiv = document.createElement('div');
                        productDiv.classList.add('product');
                        productDiv.innerHTML = `
                        <a class="product-anchor" href="produkt.php?id=${product.id}">
                            <div class="product-top-half">
                                <div class="product-img-container">
                                    <img src="img/${product.image}" alt="${product.shortName}" class="product-img"/>
                                </div>
                            </div>
                        </a>
                        <div class="product-bottom-half">
                            <div class="product-description">
                                <span>${product.shortName}</span>
                                <span><strong>${product.price} zł</strong></span>
                            </div>
                            <div class="product-cart">
                                <button class="product-cart-btn" onclick="addToCart('${product.image}', '${product.shortName}', ${product.price})">
                                    <img src="icons/bag.png" class="product-cart-icon">
                                </button>
                            </div>
                        </div>
                    `;
                        productContainer.appendChild(productDiv);
                    });
                });
        }
    }

// FILTER MOD (ONLY OPTIONS LIKE PRICE, BRAND ETC.)

    function closeFilter() {
        const filterMod = document.getElementById('filter-mod');
        if (filterMod.style.display !== "none") {
            filterMod.style.display = "none";
        }
    }

    function closeFilterOnClickOutside(event) {
        const filterButton = document.getElementById('filter-div');
        const filterMod = document.getElementById('filter-mod');
        const sortDiv = document.getElementById('sort-div');
        const priceDiv = document.getElementById('price-div');
        // const brandDiv = document.getElementById('brand-div');

        if (filterButton.style.display !== "none" &&
            !filterButton.contains(event.target) &&
            !filterMod.contains(event.target) &&
            !sortDiv.contains(event.target) &&
            !priceDiv.contains(event.target)) {
            closeFilter();
        }
    }

    document.querySelector('#filter-div').addEventListener('click', function () {
        const filterMod = document.getElementById('filter-mod');
        filterMod.style.display = "grid";
    });


// EXPAND FILTER (MENU OF FILTERS)

    function setPositionFilterExpand(name) {
        const button = document.getElementById(`filter-${name}`);
        const expand = document.getElementById(`${name}-div`);

        const leftPosition = button.getBoundingClientRect().left;
        expand.style.left = `${leftPosition}px`;
    }

    function expandFilter(name) {
        document.querySelector(`#filter-${name}`).addEventListener('mouseover', function () {
            const expand = document.getElementById(`${name}-div`);
            expand.style.display = "flex";
        });
    }
    function closeFilterExpandOnClickOutside(event, name) {
        function closeFilterExpand(name) {
            const expandDiv = document.getElementById(`${name}-div`);
            if (expandDiv.style.display !== "none") {
                expandDiv.style.display = "none";
            }
        }

        const filterButton = document.getElementById(`filter-${name}`);
        const filterExpand = document.getElementById(`${name}-div`);

        if (filterButton.style.display !== "none" &&
            !filterButton.contains(event.target) &&
            !filterExpand.contains(event.target)) {
            closeFilterExpand(name);
        }
    }
    const sort = "sort";
    const price = "price";
// const brand = "brand";

    window.addEventListener('click', (event) => {
        closeFilterOnClickOutside(event);
        // expandFilter(brand);
        // closeFilterExpandOnClickOutside(event, brand);
    });

    window.addEventListener('mouseover', (event) => {
        expandFilter(sort);
        expandFilter(price);
        closeFilterExpandOnClickOutside(event, sort);
        closeFilterExpandOnClickOutside(event, price);
    })

    document.getElementById('filter-div').addEventListener('click', () => {
        setPositionFilterExpand(price)
        // setPositionFilterExpand(brand)
    });

    window.addEventListener('resize', () => {
        setPositionFilterExpand(price)
        // setPositionFilterExpand(brand)
    });


// HOW MANY FOUND PRODUCTS

    function titleOfSearch() {
        const productList = document.getElementById('product-list');
        const offerFound = document.getElementById('offer-found');
        let productWord = "";

        if (productList) {
            const productCount = productList.getElementsByClassName('product').length;
            if (productCount === 1) {
                productWord = "OFERTE";
            } else if (productCount >= 2 && productCount <= 4) {
                productWord = "OFERTY";
            } else {
                productWord = "OFERT";
            }

            offerFound.innerHTML = `ZNALEZIONO ${productCount} ${productWord}`;
        }
    }

    titleOfSearch();
    document.addEventListener('keydown', titleOfSearch);
    document.addEventListener('keyup', titleOfSearch);


}); // DOM
document.addEventListener("DOMContentLoaded", () => { //DOM

// OVERWRITE FUNCTION closeModalOnClickOutside FROM COMMON.JS

    window.closeModalOnClickOutside = function(event) {
        const modal = document.getElementById('cart-modal');
        const cartIcon = document.getElementById('cart-icon-container');
        const buttons = Array.from(document.getElementsByClassName('product-cart-btn'));

        const isButtonClick = buttons.some(button => button.contains(event.target));

        if (modal.style.display !== "none" &&
            !modal.contains(event.target) &&
            !cartIcon.contains(event.target) &&
            !isButtonClick ) {
            // console.log('zamknalem modal z funckji closeModalOnOutsideSearch')
            closeModal();
        }
    }

// DROPDOOWN (MENU CATEGORIES) & SEARCHING IN NAVBAR

    const searchInput = document.querySelector('.search-input');
    const categoryDropdown = document.querySelector('.dropbtn');
    const searchButton = document.querySelector('.search-button');
    let selectedCategory = '';

    searchInput.addEventListener('input', function() {
        performSearch();
    });

    searchInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            performSearch(true);
        }
    });

    categoryDropdown.addEventListener('click', function() {
        loadCategories();
    });

    searchButton.addEventListener('click', function(event) {
        event.preventDefault();
        performSearch(true);
    });

    function loadCategories() {
        fetch('php/load_categories.php')
            .then(response => response.json())
            .then(data => {
                const dropdownContent = document.getElementById('dropdown-content');
                dropdownContent.innerHTML = '';
                data.categories.forEach(category => {
                    const option = document.createElement('a');
                    option.textContent = category.name;
                    option.dataset.id = category.id;
                    option.addEventListener('click', () => {
                        categoryDropdown.textContent = category.name;
                        selectedCategory = category.name;
                    });
                    dropdownContent.appendChild(option);
                });
            });
    }

    function performSearch(navigate = false) {
        const query = searchInput.value;
        let category = selectedCategory || '';

        if (navigate) {
            window.location.href = `wyszukiwarka.php?query=${query}&category=${category}`;
        } else {
            fetch(`php/search_products.php?query=${query}&category=${category}`)
                .then(response => response.json())
                .then(data => {
                    // titleOfSearch();

                    const productContainer = document.querySelector('.product-list');
                    productContainer.innerHTML = '';
                    data.products.forEach(product => {
                        const productDiv = document.createElement('div');
                        productDiv.classList.add('product');
                        productDiv.innerHTML = `
                        <a class="product-anchor" href="produkt.php?id=${product.id}">
                            <div class="product-top-half">
                                <div class="product-img-container">
                                    <img src="img/${product.image}" alt="${product.shortName}" class="product-img"/>
                                </div>
                            </div>
                        </a>
                        <div class="product-bottom-half">
                            <div class="product-description">
                                <span>${product.shortName}</span>
                                <span><strong>${product.price} zł</strong></span>
                            </div>
                            <div class="product-cart">
                                <button class="product-cart-btn" onclick="addToCart('${product.image}', '${product.shortName}', ${product.price})">
                                    <img src="icons/bag.png" class="product-cart-icon">
                                </button>
                            </div>
                        </div>
                    `;
                        productContainer.appendChild(productDiv);
                    });
                });
        }
    }

// FILTER MOD (ONLY OPTIONS LIKE PRICE, BRAND ETC.)

    function closeFilter() {
        const filterMod = document.getElementById('filter-mod');
        if (filterMod.style.display !== "none") {
            filterMod.style.display = "none";
        }
    }

    function closeFilterOnClickOutside(event) {
        const filterButton = document.getElementById('filter-div');
        const filterMod = document.getElementById('filter-mod');
        const sortDiv = document.getElementById('sort-div');
        const priceDiv = document.getElementById('price-div');
        // const brandDiv = document.getElementById('brand-div');

        if (filterButton.style.display !== "none" &&
            !filterButton.contains(event.target) &&
            !filterMod.contains(event.target) &&
            !sortDiv.contains(event.target) &&
            !priceDiv.contains(event.target)) {
            closeFilter();
        }
    }

    document.querySelector('#filter-div').addEventListener('click', function () {
        const filterMod = document.getElementById('filter-mod');
        filterMod.style.display = "grid";
    });


// EXPAND FILTER (MENU OF FILTERS)

    function setPositionFilterExpand(name) {
        const button = document.getElementById(`filter-${name}`);
        const expand = document.getElementById(`${name}-div`);

        const leftPosition = button.getBoundingClientRect().left;
        expand.style.left = `${leftPosition}px`;
    }

    function expandFilter(name) {
        document.querySelector(`#filter-${name}`).addEventListener('mouseover', function () {
            const expand = document.getElementById(`${name}-div`);
            expand.style.display = "flex";
        });
    }
    function closeFilterExpandOnClickOutside(event, name) {
        function closeFilterExpand(name) {
            const expandDiv = document.getElementById(`${name}-div`);
            if (expandDiv.style.display !== "none") {
                expandDiv.style.display = "none";
            }
        }

        const filterButton = document.getElementById(`filter-${name}`);
        const filterExpand = document.getElementById(`${name}-div`);

        if (filterButton.style.display !== "none" &&
            !filterButton.contains(event.target) &&
            !filterExpand.contains(event.target)) {
            closeFilterExpand(name);
        }
    }
    const sort = "sort";
    const price = "price";
// const brand = "brand";

    window.addEventListener('click', (event) => {
        closeFilterOnClickOutside(event);
        // expandFilter(brand);
        // closeFilterExpandOnClickOutside(event, brand);
    });

    window.addEventListener('mouseover', (event) => {
        expandFilter(sort);
        expandFilter(price);
        closeFilterExpandOnClickOutside(event, sort);
        closeFilterExpandOnClickOutside(event, price);
    })

    document.getElementById('filter-div').addEventListener('click', () => {
        setPositionFilterExpand(price)
        // setPositionFilterExpand(brand)
    });

    window.addEventListener('resize', () => {
        setPositionFilterExpand(price)
        // setPositionFilterExpand(brand)
    });


// HOW MANY FOUND PRODUCTS

    function titleOfSearch() {
        const productList = document.getElementById('product-list');
        const offerFound = document.getElementById('offer-found');
        let productWord = "";

        if (productList) {
            const productCount = productList.getElementsByClassName('product').length;
            if (productCount === 1) {
                productWord = "OFERTE";
            } else if (productCount >= 2 && productCount <= 4) {
                productWord = "OFERTY";
            } else {
                productWord = "OFERT";
            }

            offerFound.innerHTML = `ZNALEZIONO ${productCount} ${productWord}`;
        }
    }

    titleOfSearch();
    document.addEventListener('keydown', titleOfSearch);
    document.addEventListener('keyup', titleOfSearch);


}); // DOM