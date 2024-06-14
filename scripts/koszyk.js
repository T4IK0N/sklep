// PRZEJDZ DO PLATNOSCI (zrobic)


function deleteProduct() {
    console.log('chuj');
}


// pozycja ceny w koszyku (zeby zawsze byla na gorze i w jednej pozycji)

// let lastScrollTop = window.scrollY || document.documentElement.scrollTop;

// window.addEventListener('scroll', function() {

//     const cart = document.getElementById('cart-price');
//     const cart_rect = cart.getBoundingClientRect();
//     const products = document.getElementById('cart-products');
//     const products_rect = products.getBoundingClientRect();

//     const scrollTop = window.scrollY || window.pageYOffset;
//     const scrollBottom = scrollTop + cart_rect.height;

//     if (products_rect.top < 0) {
//         if (products_rect.top <= 0) {
//             cart.style.top = scrollTop + 'px';
//         } else {
//             cart.style.top = products_rect.top + 'px';
//         }
//     }
    
//     // if (cart_rect.y  products_rect.y) {
//     //     cart.style.top = 0 + 'px';
//     // }

//     console.log("Najwyższy widoczny punkt:", scrollTop);
//     console.log("Najniższy widoczny punkt:", scrollBottom);
//     console.log("cart rect: ", cart_rect.top, cart_rect.bottom);
// });