<?php

require_once("recursos/config/db.php");
require_once("controladores/controller_temas.php");
require_once("modelos/model_archivos.php");


$tema = new Temas();
$tema->setTable("Temas");
$tema->setView('view_temas');

$tema->setKey('IdTema');

$tema->setColumns('Titulo');
$tema->setColumns('Descripcion');
$tema->setColumns('IdArchivo');

$tema->setColumnsView('Titulo');
$tema->setColumnsView('Descripcion');

$IdTema = $_GET['IdTema'] ?? $_POST['IdTema'] ?? null;

if (isset($IdTema) && !empty($IdTema)) {
    // $dttemawhere = $tema->getWhere($IdTema);
    $dtviewtema = $tema->getWhereview($IdTema);
} else {
    $IdTema = null;
    $dttemawhere = null;
    $dtviewtema = null;

    if (!empty($_GET['page']) && $_GET['page'] == "Temas") {
        $dttemasview = !empty($_POST['filter']) ? $tema->getWhereFilter($_POST['filter']) : $tema->getView();
        $filter = $_POST['filter'] ?? "";
    } else {
        $dttemasview = $tema->getView();
    }
}


// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actiontem'])) && (isset($_GET['actiontem']))) {
    $actiontem = $_GET['actiontem'];

    if ($actiontem === 'insert') {

        $tema->values[] = "'" . $_POST['Titulo'] . "'";
        $tema->values[] = "'" . $_POST['Descripcion'] . "'";
        $tema->values[] = $Idfile;

        $tema->insertTema();

        echo '<script>location.replace("index.php?page=TemasAdmin&ins=Ok");</script>';

    } elseif ($actiontem === 'update') {

        foreach ($dttemawhere as $rowid):
            $IdArchivoT = $rowid['IdArchivo'];
        endforeach;

        $tema->values[] = "" . $_POST['Titulo'] . "";
        $tema->values[] = "" . $_POST['Descripcion'] . "";

        if($Idfile !== "NULL"){
            $tema->values[] = $Idfile;
        }else{
            $tema->values[] = $IdArchivoT;
        }

        $tema->updateTema($IdTema);

        echo '<script>location.replace("index.php?page=TemasAdmin&upd=Ok");</script>';

    } elseif ($actiontem === 'delete') {
        foreach ($dttemawhere as $rowid):
            $IdArchivoT = $rowid['IdArchivo'];
        endforeach;

        $tema->deleteTema($IdTema);

        if (isset($IdArchivoT)) {
            $archivo->deleteArchivo($IdArchivoT);
        }

        echo '<script>location.replace("index.php?page=TemasAdmin&del=Ok");</script>';
    }
}