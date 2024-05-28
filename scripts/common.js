// MODAL

let cart = loadCartFromLocalStorage();
let cartCount = cart.length;

function saveCartToLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function loadCartFromLocalStorage() {
    const savedCart = localStorage.getItem('cart');
    return savedCart ? JSON.parse(savedCart) : [];
}

function addToCart(productName, productPrice) {
    const existingProductIndex = cart.findIndex(item => item.name === productName);
    if (existingProductIndex !== -1) {
        cart[existingProductIndex].quantity += 1;
        cart[existingProductIndex].price += productPrice;
    } else {
        const product = { name: productName, price: productPrice, unitPrice: productPrice, quantity: 1 };
        cart.push(product);
        cartCount++;
    }
    saveCartToLocalStorage();
    updateCartIcon();
    updateCartItems();
}

function updateCartIcon() {
    const cartIconText = document.querySelector('.cart-icon-container p');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartIconText.textContent = `Koszyk (${totalItems})`;
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
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '';
    let total = 0;

    cart.forEach((item, index) => {
        const itemElement = document.createElement('div');
        itemElement.classList.add('cart-item');

        const itemElement2 = document.createElement('div');
        itemElement2.classList.add('cart-item-nameAndPrice');
        itemElement2.innerHTML = `
            <span class="cart-item-name">${item.name}</span>
            <span class="cart-item-price">${item.quantity} x ${item.unitPrice.toFixed(2)} zł</span>
        `;

        const itemRemoveElement = document.createElement('div');
        itemRemoveElement.classList.add('cart-item-remove');
        itemRemoveElement.innerHTML = `
            <button class="btn-remove" id="btn-remove" onclick="removeFromCart(${index})">
                <span class="material-symbols-light--close remove-icon"></span>
            </button>
        `;

        itemElement.appendChild(itemElement2);
        itemElement.appendChild(itemRemoveElement);

        cartItemsContainer.appendChild(itemElement);
        total += item.price;
    });

    document.getElementById('cart-total').textContent = `${total.toFixed(2)} zł`;
}


function removeFromCart(index) {
    if (cart[index].quantity > 1) {
        cart[index].quantity -= 1;
        cart[index].price -= cart[index].unitPrice;
    } else {
        cart.splice(index, 1);
    }
    cartCount = Math.max(0, cartCount - 1);
    saveCartToLocalStorage();
    updateCartIcon();
    updateCartItems();
}

function redirectToSubpage(relativeUrl) {
    window.location.href = relativeUrl;
}

function placeOrder() {
    closeModal();
    updateCartIcon();
    redirectToSubpage('koszyk.html');
}

// function placeOrderOther() {
//     alert('uzywasz funkcji placeOrderOther() teraz');
//     closeModal();
//     updateCartIcon();
//     redirectToSubpage('../koszyk.html');
// }

function closeModalOnClickOutside(event) {
    const modal = document.getElementById('cart-modal');
    const cartIcon = document.getElementById('cart-icon-container');
    const buttons = Array.from(document.getElementsByClassName('product-cart-btn'));
    const button = document.getElementById('order-btn');

    const isButtonClick = buttons.some(button => button.contains(event.target));

    if (!modal.contains(event.target) && !cartIcon.contains(event.target && !button.contains(event.target))) {
        closeModal();
    }
}

document.addEventListener('click', closeModalOnClickOutside);

function closeModal() {
    const modal = document.getElementById('cart-modal');
    modal.style.display = "none";
}

closeModal();
updateCartIcon();
