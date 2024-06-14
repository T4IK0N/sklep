// // PRODUCTS
//
// let product = document.querySelector(".product");
// if (product) {
//     let container1 = document.querySelector(".product-list:nth-child(2)");
//     if (container1) {
//         for (let i = 0; i < 5; i++) {
//             container1.appendChild(product.cloneNode(true));
//         }
//     }
//
//     let container2 = document.querySelector(".product-list:nth-child(4)");
//     if (container2) {
//         for (let i = 0; i < 6; i++) {
//             container2.appendChild(product.cloneNode(true));
//         }
//     }
// }

// FUNCTION FROM COMMON.JS

function closeModalOnClickOutside(event) {
    const modal = document.getElementById('cart-modal');
    const cartIcon = document.getElementById('cart-icon-container');
    const buttonSpecial = document.getElementById('product-cart-btn-special');
    const buttons = Array.from(document.getElementsByClassName('product-cart-btn'));


    if (modal.style.display !== "none" &&
        !modal.contains(event.target) &&
        !cartIcon.contains(event.target) &&
        !buttonSpecial.contains(event.target)) {
        closeModal();
    }
}
