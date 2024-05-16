<?php

require_once("recursos/config/db.php");
require_once("controladores/controller_marcas.php");
require_once("modelos/model_archivos.php");


$marca = new Marcas();
$marca->setTable("Marcas");
$marca->setView('view_marcas');

$marca->setKey('IdMarca');

$marca->setColumns('NombreMarca');
$marca->setColumns('IdArchivo');

$marca->setColumnsView('NombreMarca');

$IdMarca = $_GET['IdMarca'] ?? $_POST['IdMarca'] ?? null;

if (isset($IdMarca) && !empty($IdMarca)) {
    // $dtmarcawhere = $marca->getWhere($IdMarca);
    $dtviewmarca = $marca->getWhereview($IdMarca);
} else {
    $IdMarca = null;
    $dtmarcawhere = null;
    $dtviewmarca = null;

    if (!empty($_GET['page']) && $_GET['page'] == "EdicionProductos") {
        $dtmarcasview = $_GET['page'] == "EdicionProductos" ? $marca->getAll() : $marca->getView();
    } else {
        $dtmarcasview = $marca->getView();
    }
}


// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionmar'])) && (isset($_GET['actionmar']))) {
    $actionmar = $_GET['actionmar'];

    if ($actionmar === 'insert') {

        $marca->values[] = "'" . $_POST['NombreMarca'] . "'";
        $marca->values[] = $Idfile;

        $marca->insertMarca();

        echo '<script>location.replace("index.php?page=MarcasAdmin&ins=Ok");</script>';

    } elseif ($actionmar === 'update') {

        foreach ($dtviewmarca as $rowid):
            $IdArchivoM = $rowid['IdArchivo'];
        endforeach;

        $marca->values[] = "" . $_POST['NombreMarca'] . "";

        if($Idfile !== "NULL"){
            $marca->values[] = $Idfile;
        }else{
            $marca->values[] = $IdArchivoM;
        }

        $marca->updateMarca($IdMarca);

        echo '<script>location.replace("index.php?page=MarcasAdmin&upd=Ok");</script>';

    } elseif ($actionmar === 'delete') {
        foreach ($dtviewmarca as $rowid):
            $IdArchivoM = $rowid['IdArchivo'];
        endforeach;

        $marca->deleteMarca($IdMarca);

        if (isset($IdArchivoM)) {
            $archivo->deleteArchivo($IdArchivoM);
        }

        echo '<script>location.replace("index.php?page=MarcasAdmin&del=Ok");</script>';
    }
}