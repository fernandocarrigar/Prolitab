document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelector('.carousel-secondary-items');
    if (!items) {
        return;
    }

    const itemCount = document.querySelectorAll('.carousel-secondary-item').length;
    let itemShown = getItemShown();
    let currentShift = 0;

    function getItemShown() {
        if (window.innerWidth >= 1024) {
            return 4;
        } else if (window.innerWidth >= 768) {
            return 3;
        } else if (window.innerWidth >= 480) {
            return 2;
        } else {
            return 1;
        }
    }

    function updateCarousel() {
        items.style.transform = `translateX(-${100 * currentShift / itemShown}%)`;
    }

    window.addEventListener('resize', function () {
        itemShown = getItemShown();
        updateCarousel(); // Actualiza el carrusel al cambiar el tamaño de la ventana
    });

    document.querySelector('.carousel-secondary-next').addEventListener('click', function () {
        if (currentShift < itemCount - itemShown) {
            currentShift++;
        } else {
            currentShift = 0; // Reinicia al inicio si alcanza el final
        }
        updateCarousel();
    });

    document.querySelector('.carousel-secondary-prev').addEventListener('click', function () {
        if (currentShift > 0) {
            currentShift--;
        } else {
            currentShift = itemCount - itemShown; // Va al final si está en el inicio
        }
        updateCarousel();
    });
});