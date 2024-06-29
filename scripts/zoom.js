const container = document.getElementById("product-image");
const img = document.getElementById("main-image");

function onZoomMouse(e) {
    const x = e.clientX - e.target.offsetLeft;
    const y = e.clientY - e.target.offsetTop;
    img.style.transformOrigin = `${x}px ${y}px`;
    img.style.transform = "scale(2.5)";
}
function offZoomMouse(e) {
    img.style.transformOrigin = `center center`;
    img.style.transform = "scale(1)";
}

function onZoomTouch(e) {
    e.preventDefault(); // Zapobiega domyślnemu zachowaniu przeglądarki podczas gestów dotykowych

    if (e.touches.length === 2) {
        const touch1 = e.touches[0];
        const touch2 = e.touches[1];

        const x = (touch1.pageX + touch2.pageX) / 2 - container.offsetLeft;
        const y = (touch1.pageY + touch2.pageY) / 2 - container.offsetTop;

        img.style.transformOrigin = `${x}px ${y}px`;
        img.style.transform = "scale(2.5)";
    }
}

function offZoomTouch(e) {
    img.style.transformOrigin = `center center`;
    img.style.transform = "scale(1)";
}

container.addEventListener("touchmove", onZoomTouch);
container.addEventListener("touchstart", onZoomTouch);
container.addEventListener("touchend", offZoomTouch);
container.addEventListener("mousemove", onZoomMouse);
container.addEventListener("mouseover", onZoomMouse);
container.addEventListener("mouseleave", offZoomMouse);