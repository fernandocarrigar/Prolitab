<?php
session_start();
require_once("recursos/config/db.php");
require_once("vistas/template/navbar/navbar.php");
require_once("controladores/controller_login.php");

if ((!empty($_GET['page']))  ||  (isset($_GET['page']))) {
    $page = $_GET['page'];
} else {
    $page = "";
}

if (!empty($_GET['p']) && is_numeric($_GET['p'])) {
    $currentPage = intval($_GET['p']);
} else {
    $currentPage = 1;
}

if (requiresAuthentication($page)) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        echo "<script>alert('Acceso denegado'); window.history.back();</script>";
        exit;
    }
}

function requiresAuthentication($page)
{
    // Lista de páginas que requieren autenticación
    $adminPages = [
        'ImgCarruselAdmin',
        'PublicidadesAdmin',
        'EdicionImgCarrusel',
        'EdicionPublicidad',
        'EdicionLogo',
        'InfoContacto',
        'NosotrosAdmin',
        'EdicionProductos',
        'ProductosAdmin',
        'ArchivosAdmin',
        'ArchivosCarga',
        'EdicionTema',
        'TemasAdmin',
        'EdicionMarca',
        'MarcasAdmin',
        'EdicionCliente',
        'ClientesAdmin',
        'TiposProductosAdmin',
        'EdicionTProductos',
    ];

    return in_array($page, $adminPages);
}

switch ($page) {
    //------------------- ADMIN ------------------------------------------------------------------------------------------------------------

    //------------------- TEMAS ----------------------
    case "ArchivosCarga":
        include_once("vistas/users/admin/Archivos/ArchivosCarga.php");
        break;
    case "ArchivosAdmin":
        include_once("vistas/users/admin/Archivos/ArchivosDescargables.php");
        break;
    //------------------- TEMAS ----------------------

    //------------------- TEMAS ----------------------
    case "EdicionTema":
        include_once ("vistas/users/admin/Temas/EdicionTema.php");
        break;
    case "TemasAdmin":
        include_once ("vistas/users/admin/Temas/TemasAdmin.php");
        break;
    //------------------- TEMAS ----------------------

    //------------------- MARCAS ----------------------
    case "EdicionMarca":
        include_once ("vistas/users/admin/Marcas/EdicionMarcas.php");
        break;
    case "MarcasAdmin":
        include_once ("vistas/users/admin/Marcas/MarcasAdmin.php");
        break;
    //------------------- MARCAS ----------------------

    //------------------- CLIENTES ----------------------
    case "EdicionCliente":
        include_once ("vistas/users/admin/Clientes/EdicionClientes.php");
        break;
    case "ClientesAdmin":
        include_once ("vistas/users/admin/Clientes/ClientesAdmin.php");
        break;
    //------------------- CLIENTES ----------------------

    //------------------- PUBLICACIONES ----------------------
    case "ImgCarruselAdmin":
        include_once ("vistas/users/admin/Publicaciones/ImgCarrusel.php");
        break;
    case "PublicidadesAdmin":
        include_once ("vistas/users/admin/Publicaciones/Publicidades.php");
        break;
    case "EdicionImgCarrusel":
        include_once ("vistas/users/admin/Publicaciones/EdicionImgCarrusel.php");
        break;
    case "EdicionPublicidad":
        include_once ("vistas/users/admin/Publicaciones/EdicionPublicidad.php");
        break;
    case "EdicionLogo":
        include_once ("vistas/users/admin/Publicaciones/EdicionLogo.php");
        break;
    //------------------- PUBLICACIONES ----------------------

    //------------------- CONFIGURABLES ----------------------
    case "InfoContacto":
        include ("vistas/users/admin/Configuraciones/EdicionFooter.php");
        break;
    case "NosotrosAdmin":
        include_once ("vistas/users/admin/Configuraciones/NosotrosAdmin.php");
        break;
    //------------------- CONFIGURABLES ----------------------

    //------------------- PRODUCTOS ----------------------
    case "EdicionProductos":
        include_once ("vistas/users/admin/Productos/EdicionProductos.php");
        break;
    case "ProductosAdmin":
        include_once ("vistas/users/admin/Productos/Productos.php");
        break;
    //------------------- PRODUCTOS ----------------------

    //------------------- LOGIN ----------------------
    case "Login":
        include_once ("vistas/template/login/login.php");
        break;
    //------------------- LOGIN ----------------------

    //------------------- TIPOS DE PRODUCTOS ----------------------
    case "TiposProductosAdmin":
        include_once ('vistas/users/admin/TipoProductos/TiposProductos.php');
        break;
    case "EdicionTProductos":
        include_once ('vistas/users/admin/TipoProductos/EdicionTiposProductos.php');
        break;
    //------------------- TIPOS DE PRODUCTOS ----------------------
    
    //------------------- ADMIN ------------------------------------------------------------------------------------------------------------
    
    //------------------- CLIENTE ------------------------------------------------------------------------------------------------------------

    //------------------- NOSOTROS ----------------------
    case "Nosotros":
        include_once("vistas/usuarios/cliente/Nosotros.php");
        break;
    case "Productos":
        include_once("vistas/usuarios/cliente/Productos.php");
        break;
    //------------------- NOSOTROS ----------------------
    
    //------------------- CLIENTE ------------------------------------------------------------------------------------------------------------

    default:
        include_once ('vistas/home/Home.php');
        break;
}

require_once("vistas/template/footer/footer.php");
