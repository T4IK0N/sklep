// PRODUCTS

let product = document.querySelector(".product");
if (product) {
    let container1 = document.querySelector(".product-list:nth-child(2)");
    if (container1) {
        for (let i = 0; i < 5; i++) {
            container1.appendChild(product.cloneNode(true));
        }
    }

    let container2 = document.querySelector(".product-list:nth-child(4)");
    if (container2) {
        for (let i = 0; i < 6; i++) {
            container2.appendChild(product.cloneNode(true));
        }
    }
}