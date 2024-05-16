<?php
include_once ('modelos/model_archivosfisicos.php');
include_once ('modelos/model_publicaciones.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- Estilos CSS -->
    <link rel="stylesheet" type="text/css" href="recursos\css\general.css">
    <link rel="stylesheet" type="text/css" href="recursos\css\navbar.css">
    <link rel="stylesheet" type="text/css" href="recursos\css\home.css">
    <link rel="stylesheet" type="text/css" href="recursos\css\footer.css">
    <link rel="stylesheet" type="text/css" href="recursos\css\nosotros.css">
    <link rel="stylesheet" type="text/css" href="recursos\css\productos.css">

    <!-- VERIFICAR USO -->
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/Contacto.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/ContactoFooter.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/EdicionImgCarrusel.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/EdicionMarcas.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/EdicionProd.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/ImgCarrusel.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/Nosotros.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/login.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/Productos.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/Servicios.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/TiposProductos.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/maybe/FuncionSistema.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/form-descargables.css">
    <!-- VERIFICAR USO -->

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="recursos\lib\bootstrap\css\bootstrap.min.css">
    <!-- Estilos CSS -->
</head>

<body>
    <nav class="navegacion-bar">
        <?php
        $Clave = "Logo";
        $TpFilePub = "";
        $FilePub = "";

        if (isset($dtlogo)) {
            foreach ($dtlogo as $row):
                $Clave = $row["Clave"];
                $TpFilePub = $row["TipoArchivoPub"];
                $FilePub = $row["ArchivoPub"];
            endforeach;
        }
        ?>
        <div class="navegacion-logo"><img id="logo"
                src="data:<?php echo $TpFilePub ?>;base64,<?php echo (base64_encode($FilePub)) ?>" alt="<?= $Clave ?>"
                class="img-thumbnail" style="max-width:50px; max-height:50px;" /></div>
        <div class="navegacion-menu" id="navegacionMenu">
            <a href="index.php?page=" class="navegacion-item">Inicio</a>
            <a href="index.php?page=Productos" class="navegacion-item">Productos</a>
            <a href="index.php?page=Nosotros" class="navegacion-item">Nosotros</a>
            <a href="#" class="navegacion-item">Contacto</a>
            <!-- Agregando Dropdown de Descargas -->
            <?php
            if (isset($ArchivosDescargables) && !empty($ArchivosDescargables)) {
                ?>
                <div class="dropdown">
                    <button class="dropbtn navegacion-item">Descargas</button>
                    <div class="dropdown-content">
                        <?php
                        foreach ($ArchivosDescargables as $row):
                            $extension = explode(".", $row);
                            $ext = (count($extension) - 1);
                            ?>
                            <a href="<?= $row ?>" download><?= basename($row, "" . $extension[$ext] . "") ?></a>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <?php
            }
            if (isset($_SESSION['loggedin'])) {
                if ($_SESSION['loggedin'] === true) {
                    ?>
                    <!-- Botón Admin solo visible en móviles -->
                    <button type="button" class="admin-btn-mobile" onclick="toggleAdminSidebar()">Menú Admin</button>
                <?php
                }
            }
            ?>
        </div>
        <?php
        if (isset($_SESSION['loggedin'])) {
            if ($_SESSION['loggedin'] === true) {
                ?>
                <button type="button" class="navegacion-btn" onclick="toggleMenu()">
                    <span></span>
                </button>
                <!-- Botón Admin visible en escritorio -->
                <button type="button" class="admin-btn" onclick="toggleAdminSidebar()">
                    Menú Admin
                </button>
            <?php
            }
        }
        ?>
    </nav>

    <?php
    if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['loggedin'] === true) {
            ?>
            <!-- Sidebar de administrador -->
            <div class="admin-sidebar" id="adminSidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeAdminSidebar()">&times;</a>
                <a href="index.php?page=PublicidadesAdmin" class="admin-link">Publicidades</a>
                <a href="index.php?page=ImgCarruselAdmin" class="admin-link">Imagenes de Carrusel</a>
                <a href="index.php?page=ArchivosAdmin" class="admin-link">Archivos descargables</a>
                <a href="index.php?page=ProductosAdmin" class="admin-link">Productos</a>
                <a href="index.php?page=MarcasAdmin" class="admin-link">Marcas</a>
                <a href="index.php?page=TemasAdmin" class="admin-link">Temas</a>
                <a href="index.php?page=ClientesAdmin" class="admin-link">Clientes</a>
                <a href="index.php?page=TiposProductosAdmin" class="admin-link">Tipos de Productos</a>
                <a href="index.php?page=EdicionLogo" class="admin-link">Logo de la Empresa</a>
                <a href="index.php?page=InfoContacto" class="admin-link">Configuración de Contacto</a>
                <a href="cerrar.php" class="admin-link">Cerrar sesion</a>
            </div>
            <?php
        }
    }
    ?>
</body>


</html>