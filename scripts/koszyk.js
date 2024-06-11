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