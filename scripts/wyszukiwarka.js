// let product = document.querySelector(".product");
// for (let i = 0; i < 8; i++) {
//     product.parentElement.appendChild(product.cloneNode(true));
// }


// FUNCTION FROM COMMON.JS

function closeModalOnClickOutside(event) {
    const modal = document.getElementById('cart-modal');
    const cartIcon = document.getElementById('cart-icon-container');
    const buttons = Array.from(document.getElementsByClassName('product-cart-btn'));

    const isButtonClick = buttons.some(button => button.contains(event.target));

    if (modal.style.display !== "none" &&
        !modal.contains(event.target) &&
        !cartIcon.contains(event.target) &&
        !isButtonClick ) {
        closeModal();
    }
}
