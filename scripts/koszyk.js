// CLOSE MODAL ON START

closeModal();

// PRZEJDZ DO PLATNOSCI (zrobic)


// FUNCTION FROM COMMON.JS

function closeModalOnClickOutside(event) {
    const modal = document.getElementById('cart-modal');
    const cartIcon = document.getElementById('cart-icon-container');

    if (modal.style.display !== "none" &&
        !modal.contains(event.target) &&
        !cartIcon.contains(event.target)) {
        closeModal();
    }
}


function deleteProduct() {
    console.log('chuj');
}


// pozycja ceny w koszyku (zeby zawsze byla na gorze i w jednej pozycji)

// function f() {
//     const cart = document.getElementById('cart-price');
//     const rect = cart.getBoundingClientRect();

//     setInterval(() => {
//         console.log(rect.top);
//     }, 500)
// }

// window.addEventListener('resize', f());