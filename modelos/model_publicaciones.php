<?php

require_once('recursos/config/db.php');
require_once('controladores/controller_publicaciones.php');
require_once('modelos/model_archivos.php');

$publicacion = new Publicacion();
$publicacion->setTable("Publicaciones");
$publicacion->setView('view_publicaciones');

$publicacion->setKey('IdPublicacion');

$publicacion->setColumns('CampoKey');
$publicacion->setColumns('Titulo');
$publicacion->setColumns('Descripcion');
$publicacion->setColumns('IdArchivo');

$fch_r = date('Y-m-d'); //OBTIENE LA FECHA ACTUAL

$IdPublicacion = $_GET['IdPublicacion'] ?? $_POST['IdPublicacion'] ?? null;

if(isset($IdPublicacion) && !empty($IdPublicacion)){
    $dtpubwhere = $publicacion->getWhereview($IdPublicacion);
}else{
    $dtpubwhere = null;
}

$dtlogo = $publicacion->getWhereClave('Logo');
$p = $_GET['page'] ?? null;

if(!isset($p) || empty($p) || ($p === "ImgCarruselAdmin")){
    $dtcarrusel = $publicacion->getWhereClave('Carrusel');
}elseif(!isset($p) || empty($p) || ($p === "PublicidadesAdmin")){
    $dtpublicidad = $publicacion->getWhereClave('Publicidad');
}
//$dtpublicaciones = $publicacion->getView();

// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionpub'])) && (isset($_GET['actionpub']))) {
    $actionpub = $_GET['actionpub'];
    if ($actionpub === 'insert') {
        // COMPROBAMOS QUE TODOS LOS ARCHIVOS HAYAN SIDO CORRECTOS
        $publicacion->values[] = "'" . $_POST['CampoKey'] . "'";
        $publicacion->values[] = "'" . $_POST['Titulo'] . "'" ?? "";
        $publicacion->values[] = "'" . $_POST['Descripcion'] . "'" ?? "";
        $publicacion->values[] = $Idfile;

        $publicacion->insertPub();

        echo '<script>location.replace("index.php?page='. $_GET['page'] .'&ins=Ok");</script>';

    } else if ($actionpub === 'update') {

        foreach ($dtpubwhere as $rowid):
            $IdArchivoPub = $rowid['IdArchivo'];
        endforeach;

        $publicacion->values[] = "'" . $_POST['CampoKey'] . "'";
        $publicacion->values[] = "'" . $_POST['Titulo'] . "'";
        $publicacion->values[] = "'" . $_POST['Descripcion'] . "'";

        if ($Idfile !== "NULL" || (!empty($Idfile) && isset($Idfile))) {
            $publicacion->values[] = $Idfile;
        } else {
            $publicacion->values[] = $IdArchivoPub;
        }

        $publicacion->updatePub($IdPublicacion);

        echo '<script>location.replace("index.php?page='. $_GET['page'] .'&upd=Ok");</script>';

    } else if ($actionpub === 'delete') {
        foreach ($dtpubwhere as $row):
            $Idarchdel = $row['IdArchivo'];
        endforeach;

        $publicacion->deletePub($IdPublicacion);

        if (isset($Idarchdel)) {
            $archivo->deleteArchivo($Idarchdel);
        }

        echo '<script>location.replace("index.php?page='. $_GET['page'] .'&del=Ok");</script>';
    }
}
