function toggleMenu() {
    var menu = document.getElementById("navegacionMenu");
    var btn = document.querySelector('.navegacion-btn');
    if (menu.style.display === "block") {
        menu.style.display = "none";
        btn.classList.remove('active');
    } else {
        menu.style.display = "block";
        btn.classList.add('active');
    }
}

// Restablecer la visualización del menú en cambio de tamaño de ventana
window.onresize = function () {
    var menu = document.getElementById("navegacionMenu");
    var btn = document.querySelector('.navegacion-btn');
    if (window.innerWidth > 768) {
        menu.style.display = "";
        btn.classList.remove('active');
    }
};
