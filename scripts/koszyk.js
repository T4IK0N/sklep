// PRZEJDZ DO PLATNOSCI (zrobic)

function deleteProduct() {
    console.log('chuj');
}

function paymentAnchor() {
    window.location.href = 'platnosc.php';
}

function isCartEmpty() {
    fetch('php/fetch_cart.php')
        .then(response => response.json())
        .then(cart => {
            const title = document.querySelector('.title');
            if (cart.length === 0) {
                title.textContent = 'KOSZYK JEST PUSTY';
            } else {
                title.textContent = 'KOSZYK';
                renderCartItems(cart);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

function renderCartItems(cart) {
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '';
    let total = 0;

    cart.forEach((item, index) => {
        const itemElement = document.createElement('div');
        itemElement.classList.add('cart-item');

        const itemElement2 = document.createElement('div');
        itemElement2.classList.add('cart-item-left');

        const itemElement3 = document.createElement('div');
        itemElement3.classList.add('cart-item-image');
        itemElement3.innerHTML = `<img src="img/${item.image}" alt="product-from-fetch">`;

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

        const itemQuantityElement = document.createElement('div');
        itemQuantityElement.classList.add('cart-item-quantity');
        itemQuantityElement.innerHTML = `
            <input type="number" value="${item.quantity}" min="1" onchange="updateCartItemQuantity(${index}, this.value)">
        `;

        itemElement.appendChild(itemElement2);
        itemElement.appendChild(itemRemoveElement);
        itemElement.appendChild(itemQuantityElement);

        itemElement2.appendChild(itemElement3);
        itemElement2.appendChild(itemElement4);

        cartItemsContainer.appendChild(itemElement);
        total += item.quantity * item.unitPrice;
    });

    document.getElementById('cart-total').textContent = `${total.toFixed(2)} zł`;

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<div class="empty-cart-message">Koszyk jest pusty.</div>';
        document.getElementById('cart-total').textContent = '0.00 zł';
    }
}

window.addEventListener('load', () => {
    isCartEmpty();
});
