// GLOBALNE
let cart = [];
let cartCount = 0;

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('cart-modal');

    // Event listener do zamykania modalu po kliknięciu poza modalem
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });
});

// PRODUCTS

let product = document.querySelector(".product");
let container1 = document.querySelector(".product-list:nth-child(2)");
for (let i = 0; i < 5; i++) {
    container1.appendChild(product.cloneNode(true));
}
let container2 = document.querySelector(".product-list:nth-child(4)");
for (let i = 0; i < 5; i++) {
    container2.appendChild(product.cloneNode(true));
}

// MODAL

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

function closeModal() {
    const modal = document.getElementById('cart-modal');
    modal.style.display = "none";
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
            <button class="btn-remove" onclick="removeFromCart(${index})">
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
    updateCartIcon();
    updateCartItems();
}

function placeOrder() {
    alert('tutaj bedzie przeniesienie do formularza!');
    cart = [];
    cartCount = 0;
    updateCartIcon();
    closeModal();
}
