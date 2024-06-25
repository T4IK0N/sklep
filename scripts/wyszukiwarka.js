// let numberOfProductDivs = document.querySelectorAll('div.product').length;
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
        closeModal();
    }
}

// function changeFormFilter(query, category) {
//
//     document.forms[0].action = `wyszukiwarka.php?query=${query}&category=${category}`;
//     console.log(document.forms[0].action);
// }

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

window.addEventListener('click', (event) => {
    closeFilterOnClickOutside(event);
});

window.addEventListener('mouseover', (event) => {
    expandFilter(sort);
    expandFilter(price);
    closeFilterExpandOnClickOutside(event, sort);
    closeFilterExpandOnClickOutside(event, price);
})

document.getElementById('filter-div').addEventListener('click', () => {
    setPositionFilterExpand(price)
});

window.addEventListener('resize', () => {
    setPositionFilterExpand(price)
});