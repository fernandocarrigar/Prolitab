<?php

require_once ("recursos/config/db.php");
require_once ("controladores/controller_tiposproductos.php");
require_once ("modelos/model_archivos.php");


$tipos = new TipoProductos();
$tipos->setTable("TipoProductos");
$tipos->setView('');

$tipos->setKey('IdTProducto');

$tipos->setColumns('Tipo');

$IdTProducto = $_GET['IdTProducto'] ?? $_POST['IdTProducto'] ?? null;

// $dttipos = isset($IdTProducto) ? $tipos->getWhere($IdTProducto) : $dttipos = $tipos->getAll();
if (isset($IdTProducto) && !empty($IdTProducto)) {
    $dttipowhere = $tipos->getWhere($IdTProducto);
} else {
    $dttipowhere = null;
    $dttipos = $tipos->getAll();
}


// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actiontp'])) && (isset($_GET['actiontp']))) {
    $actiontp = $_GET['actiontp'];

    if ($actiontp === 'insert') {

        $new = $_POST['Tipo'] ?? array();
        if (!empty($new) && isset($new)) {
            for ($i = 0; $i < count($new); $i++) {
                $tipos->values[] = "'" . $new[$i] . "'";

                $tipos->insertTP();
                $tipos->values = array();
            }
            $new = array();
        }

        echo '<script>location.replace("index.php?page=TiposProductosAdmin&ins=Ok");</script>';

    } elseif ($actiontp === 'update') {

        $tipos->values[] = "" . $_POST['Tipo'][0] . "";

        $tipos->updateTP($IdTProducto);

        echo '<script>location.replace("index.php?page=TiposProductosAdmin&upd=Ok");</script>';

    } elseif ($actiontp === 'delete') {
        $tipos->deleteTP($IdTProducto);
        echo '<script>location.replace("index.php?page=TiposProductosAdmin&del=Ok");</script>';
    }
}