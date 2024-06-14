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

// function addToCart(productName, productPrice) {
//     const existingProductIndex = cart.findIndex(item => item.name === productName);
//     if (existingProductIndex !== -1) {
//         cart[existingProductIndex].quantity += 1;
//         cart[existingProductIndex].price += productPrice;
//     } else {
//         const product = { name: productName, price: productPrice, unitPrice: productPrice, quantity: 1 };
//         cart.push(product);
//         cartCount++;
//     }
//     saveCartToLocalStorage();
//     updateCartIcon();
//     updateCartItems();
// }

function addToCart(productImage, productName, productPrice) {
    const data = { image: productImage, name: productName, price: productPrice };

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


// function updateCartIcon() {
//     const cartIconText = document.querySelector('.cart-icon-container p');
//     const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
//     cartIconText.textContent = `Koszyk (${totalItems})`;
// }

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

// function updateCartItems() {
//     const cartItemsContainer = document.getElementById('cart-items');
//     cartItemsContainer.innerHTML = '';
//     let total = 0;
//
//     cart.forEach((item, index) => {
//         const itemElement = document.createElement('div');
//         itemElement.classList.add('cart-item');
//
//         const itemElement2 = document.createElement('div');
//         itemElement2.classList.add('cart-item-nameAndPrice');
//         itemElement2.innerHTML = `
//             <span class="cart-item-name">${item.name}</span>
//             <span class="cart-item-price">${item.quantity} x ${item.unitPrice.toFixed(2)} zł</span>
//         `;
//
//         const itemRemoveElement = document.createElement('div');
//         itemRemoveElement.classList.add('cart-item-remove');
//         itemRemoveElement.innerHTML = `
//             <button class="btn-remove" onclick="removeFromCart(${index})">
//                 <span class="material-symbols-light--close remove-icon"></span>
//             </button>
//         `;
//
//         itemElement.appendChild(itemElement2);
//         itemElement.appendChild(itemRemoveElement);
//
//         cartItemsContainer.appendChild(itemElement);
//         total += item.price;
//     });
//
//     document.getElementById('cart-total').textContent = `${total.toFixed(2)} zł`;
// }

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

                const itemElement2 = document.createElement('div');
                itemElement2.classList.add('cart-item-left');

                const itemElement3 = document.createElement('div');
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
                total += item.price;
            });

            document.getElementById('cart-total').textContent = `${total.toFixed(2)} zł`;
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

// function removeFromCart(index) {
//     if (cart[index].quantity > 1) {
//         cart[index].quantity -= 1;
//         cart[index].price -= cart[index].unitPrice;
//     } else {
//         cart.splice(index, 1);
//     }
//     cartCount = Math.max(0, cartCount - 1);
//     saveCartToLocalStorage();
//     updateCartIcon();
//     updateCartItems();
// }

function removeFromCart(index) {
    fetch('php/remove_from_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ index: index }),
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
        console.log('zamknalem modal');
    }
}
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', closeModalOnClickOutside);
});

closeModal();
updateCartIcon();

function closeModalOnClickOutside(event) {
    const modal = document.getElementById('cart-modal');
    const cartIcon = document.getElementById('cart-icon-container');


    if (modal.style.display !== "none" &&
        !modal.contains(event.target) &&
        !cartIcon.contains(event.target)) {
        closeModal();
    }
}


// PRODUCTS MENU
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelector('.dropbtn').addEventListener('click', function() {
        document.getElementById('dropdown-content').classList.toggle('show');
    });

    // Remove on click out of menu
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            let dropdowns = document.getElementsByClassName('dropdown-content');
            for (let i = 0; i < dropdowns.length; i++) {
                let openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
    // Remove on resize
    window.addEventListener('resize', () => {
        let dropdowns = document.getElementsByClassName('dropdown-content');
        for (let i = 0; i < dropdowns.length; i++) {
            dropdowns[i].classList.remove('show');
        }
    });
});



// POSITION MODAL

function setModulePosition() {
    const modal = document.getElementById('cart-modal');
    const cart = document.getElementById('cart-icon-container').getBoundingClientRect();
    const cartWidth = document.getElementById('cart-icon-container').clientWidth;
    const windowWidth = window.innerWidth;

    if (windowWidth <= 800) {
        const leftPosition = (cart.left - 1.5*cartWidth);
        const topPosition = (cart.bottom);

        modal.style.left = `${leftPosition}px`;
        modal.style.top = `${topPosition}px`;
    } else {
        const leftPosition = (cart.left);
        const topPosition = (cart.bottom);

        modal.style.left = `${leftPosition}px`;
        modal.style.top = `${topPosition}px`;
    }
}

// POSITION OF SEARCH

function setMenuPosition() {
    const menu = document.getElementById('dropdown-content');
    const drop = document.getElementById('dropdown').getBoundingClientRect();

    const leftPosition = drop.left;
    const topPosition = (drop.bottom + 1);

    menu.style.left = `${leftPosition}px`;
    menu.style.top = `${topPosition}px`;
}

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
                    const newHorizontalPadding = '1dvw';

                    document.documentElement.style.setProperty('--horizontal-padding', newHorizontalPadding);
                }
            }
        }
    }
}

// ALL EVENTS

window.addEventListener('resize', () => {
    changeHorizontalPadding();
    setMenuPosition();
    setModulePosition();
});

window.addEventListener('load', () => {
    changeHorizontalPadding();
    setMenuPosition();
    setModulePosition();
});

window.addEventListener('', () => {
    setMenuPosition();
    setModulePosition();
});