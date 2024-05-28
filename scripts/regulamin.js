// Load and display cart items on the cart page
document.addEventListener('DOMContentLoaded', function() {
    const cart = loadCartFromLocalStorage();
    updateCartItems(cart);
});

function updateCartItems(cart) {
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

function finalizeOrder() {
    alert('Zamówienie zostało złożone.');
    localStorage.removeItem('cart');
    window.location.href = 'index.html';
}