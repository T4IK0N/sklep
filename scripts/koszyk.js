// PRZEJDZ DO PLATNOSCI (zrobic)

function removeFromCartFull(index) {
    fetch('php/remove_from_cart_full.php', {
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
            createItems();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

function updateCartQuantity(index, value) {
    fetch('php/update_cart_quantity.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({index: index, value: value}),
    })
        .then(response => response.json())
        .then(data => {
            updateCartIcon();
            updateCartItems();
            createItems();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

function createItems() {
    fetch('php/fetch_cart.php')
        .then(response => response.json())
        .then(cart => {
            const productList = document.getElementById('product-list');
            productList.innerHTML = ''; // Clear previous items
            let total = 0;
            let delivery = 0;

            cart.forEach((item, index) => {
                const itemElement = document.createElement('div');
                itemElement.classList.add('product-div');

                const itemElementLeft = document.createElement('div');
                itemElementLeft.classList.add('product-div-element', 'product-div-left');

                const itemImage = document.createElement('a');
                itemImage.href = `produkt.php?id=${item.id}`;
                itemImage.classList.add('product-image');
                itemImage.innerHTML = `<img src="img/${item.image}">`;

                const itemDescription = document.createElement('div');
                itemDescription.classList.add('product-description');
                itemDescription.innerHTML = `
                    <div>
                        <h3 class="product-title">${item.name}</h3>
                        <span class="span-unitPrice">Cena za sztukę: ${item.unitPrice.toFixed(2)} zł</span>
                    </div>
                    <input type="number" min="1" max="10" value="${item.quantity}" onchange="updateCartQuantity(${index}, this.value)" />
                `;

                const hrLine = document.createElement('hr');
                hrLine.classList.add('grayLine');

                const itemElementRight = document.createElement('div');
                itemElementRight.classList.add('product-div-element', 'product-div-right');

                const deleteDiv = document.createElement('div');
                deleteDiv.classList.add('delete-div');
                deleteDiv.onclick = () => removeFromCartFull(index);
                deleteDiv.innerHTML = `<img src="icons/close.png" class="delete-img"/>`;

                const itemPrice = document.createElement('p');
                itemPrice.classList.add('price-cart-page')
                itemPrice.textContent = `${(item.unitPrice * item.quantity).toFixed(2)} zł`;

                itemElementLeft.appendChild(itemImage);
                itemElementLeft.appendChild(itemDescription);
                itemElementRight.appendChild(deleteDiv);
                itemElementRight.appendChild(itemPrice);

                itemElement.appendChild(itemElementLeft);
                itemElement.appendChild(itemElementRight);

                productList.appendChild(itemElement);
                productList.appendChild(hrLine);
                total += item.quantity * item.unitPrice;
            });

            const final = total + delivery;
            document.getElementById('cart-total-page').textContent = `${total.toFixed(2)} zł`;
            document.getElementById('cart-delivery-page').textContent = `${delivery.toFixed(2)} zł`;
            document.getElementById('cart-final-page').textContent = `${final.toFixed(2)} zł`;

        })
        .catch((error) => {
            console.error('Error:', error);
        });
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
                title.textContent = 'KOSZYK'
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

window.addEventListener('load', () => {
    isCartEmpty();
    createItems();
})

document.getElementById('cart-products').addEventListener('click', () => {
    isCartEmpty();
})