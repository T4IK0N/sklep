// FUNCTION FROM COMMON.JS

function closeModalOnClickOutside(event) {
    const modal = document.getElementById('cart-modal');
    const cartIcon = document.getElementById('cart-icon-container');
    const addProduct = document.getElementById('add-product');

    if (modal.style.display !== "none" &&
        !modal.contains(event.target) &&
        !cartIcon.contains(event.target) &&
        !addProduct.contains(event.target)) {
        closeModal();
    }
}