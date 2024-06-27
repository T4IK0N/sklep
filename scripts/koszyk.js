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
                title.textContent = 'KOSZYK'
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

window.addEventListener('load', () => {
    isCartEmpty();
})