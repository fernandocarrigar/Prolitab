document.addEventListener('DOMContentLoaded', function () {
    let slides = document.querySelectorAll('.home-slide');
    // Verificar si se encontraron diapositivas
    if (!slides || slides.length === 0) {
        // Si no se encontraron diapositivas, salir de la función
        return;
    }
    let slideIndex = 0;

    function showSlides(n) {
        slides.forEach((slide) => {
            slide.style.display = 'none';
            slide.style.opacity = 0;
        });

        slideIndex = (n + slides.length) % slides.length;
        slides[slideIndex].style.display = 'flex';
        slides[slideIndex].style.opacity = 1;
    }

    function nextSlide() {
        showSlides(slideIndex += 1);
    }

    // Mostrar el primer slide
    showSlides(slideIndex);

    // Event listeners para botones
    document.querySelector('.home-prev').addEventListener('click', () => showSlides(slideIndex -= 1));
    document.querySelector('.home-next').addEventListener('click', () => showSlides(slideIndex += 1));

    // Configurar el avance automático cada 5 segundos
    let autoSlideInterval = setInterval(nextSlide, 5000);

    // Agregar pausa al pasar el mouse por encima
    document.querySelector('.home-slider').addEventListener('mouseenter', () => {
        clearInterval(autoSlideInterval);
    });

    // Reanudar el avance automático al quitar el mouse de encima
    document.querySelector('.home-slider').addEventListener('mouseleave', () => {
        autoSlideInterval = setInterval(nextSlide, 3000);
    });
});
