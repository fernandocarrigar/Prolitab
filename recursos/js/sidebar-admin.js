function toggleAdminSidebar() {
    var sidebar = document.getElementById('adminSidebar');
    // Comprueba si el sidebar ya está abierto, y de ser así, ciérralo. Si no, ábrelo.
    if (sidebar.style.width === '250px') {
        sidebar.style.width = '0';
    } else {
        sidebar.style.width = '250px';
    }
}

function closeAdminSidebar() {
    // Establecer la anchura del sidebar a 0 para cerrarlo
    document.getElementById('adminSidebar').style.width = '0';
}

// Asegura que el clic en el botón no se confunda con un clic fuera para cerrar
document.querySelector('.admin-btn').addEventListener('click', function (event) {
    event.stopPropagation();
});

// Cerrar el sidebar al hacer clic fuera de él
window.onclick = function (event) {
    var sidebar = document.getElementById('adminSidebar');
    // Si el clic es fuera del sidebar y está abierto, entonces ciérralo
    if (!sidebar.contains(event.target) && sidebar.style.width === '250px') {
        sidebar.style.width = "0";
    }
}

function toggleMenu() {
    var menu = document.getElementById('navegacionMenu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

// Asegura que el clic en el botón no se confunda con un clic fuera para cerrar
document.querySelectorAll('.admin-btn, .admin-btn-mobile').forEach(btn => {
    btn.addEventListener('click', function (event) {
        event.stopPropagation();
    });
});

// Cerrar el sidebar al hacer clic fuera de él
window.onclick = function (event) {
    var sidebar = document.getElementById('adminSidebar');
    if (!sidebar.contains(event.target) && sidebar.style.width === '250px') {
        sidebar.style.width = "0";
    }
}
