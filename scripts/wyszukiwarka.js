let product = document.querySelector(".product");
for (let i = 0; i < 8; i++) {
    product.parentElement.appendChild(product.cloneNode(true));
}