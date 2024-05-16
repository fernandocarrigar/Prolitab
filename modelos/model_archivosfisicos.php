<?php
require_once('controladores/controller_archivos.php');

$archivo = new ArchivosFisicos();

if (!empty($_GET['file']) && isset($_GET['file'])) {
    $action = $_GET['file'];
    if ($action = "upload" && !empty($_FILES['Archivos']) && isset($_FILES['Archivos'])) {
        $archivo->MoverArchivos($_FILES['Archivos'], "Descargables");
        echo '<script>location.replace("index.php?page=ArchivosAdmin")</script>';
    }elseif($action = "delete"){
        if(!empty($_GET['a']) && isset($_GET['a']))
        $archivo->DeleteArchivoFisico("Descargables", $_GET['a']);
    }
}

$ArchivosDescargables = $archivo->ObtenerArchivos("Descargables");
?>