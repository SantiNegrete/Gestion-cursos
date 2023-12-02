document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector("header");
    header.style.opacity = 0;

    setTimeout(() => {
        header.style.opacity = 1;
        header.style.transition = "opacity 1s ease-in-out";
    }, 500);
});