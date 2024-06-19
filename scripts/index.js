// OVERWRITE FUNCTION closeModalOnClickOutside FROM COMMON.JS

document.addEventListener('DOMContentLoaded', () => {
    window.closeModalOnClickOutside = function(event) {
        const modal = document.getElementById('cart-modal');
        const cartIcon = document.getElementById('cart-icon-container');
        const buttons = Array.from(document.getElementsByClassName('product-cart-btn'));
        const buttonSpecial = document.getElementById('product-cart-btn-special');

        const isButtonClick = buttons.some(button => button.contains(event.target));

        if (modal.style.display !== "none" &&
            !modal.contains(event.target) &&
            !cartIcon.contains(event.target) &&
            !buttonSpecial.contains(event.target) &&
            !isButtonClick ) {
            // console.log('zamknalem modal z funckji closeModalOnOutsideIndex')
            closeModal();
        }
    }
})