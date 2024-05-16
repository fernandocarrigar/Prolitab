<?php

require_once ("recursos/config/db.php");
require_once ("controladores/controller_productos.php");
require_once("modelos/model_archivos.php");


$productos = new Productos();
$productos->setTable("Productos");
$productos->setView('view_productos');

$productos->setKey('IdProducto');

$productos->setColumns('NombreProducto');
$productos->setColumns('Descripcion');
$productos->setColumns('IdTProducto');
$productos->setColumns('IdMarca');
$productos->setColumns('IdArchivo');

$productos->setColumnsView('NombreProducto');
$productos->setColumnsView('Descripcion');
$productos->setColumnsView('TipoProducto');
$productos->setColumnsView('NombreMarca');

$IdProducto = $_GET['IdProducto'] ?? $_POST['IdProducto'] ?? null;

if ((!empty($IdProducto)) && (isset($IdProducto))) {
    // $dtproductowhere = $productos->getWhere($IdProducto);
    $dtviewproducto = $productos->getWhereview($IdProducto);
} else {
    $IdProducto = null;
    $dtproductowhere = null;
    
    if (!empty($_GET['page']) && $_GET['page'] == "Productos") {
        $dtprodsview = !empty($_POST['filter']) ? $productos->getWhereFilter($_POST['filter']) : $productos->getView();
        $filter = $_POST['filter'] ?? "";
    } else {
        $dtprodsview = $productos->getView();
    }    // $dtproductos = $productos->getAll();
    // $dtprodsview = $productos->getView();
}

$dir_doc = "recursos/Archivos/";

// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionprod'])) && (isset($_GET['actionprod']))) {
    $action = $_GET['actionprod'];

    if ($action === 'insert') {

        // INSERTAMOS LA MARCA EN LA BASE DE DATOS 
        $productos->values[] = "'" . $_POST["NombreProducto"] . "'";
        $productos->values[] = "'" . $_POST["Descripcion"] . "'";
        $productos->values[] = "" . $_POST["IdTProducto"] . "";
        $productos->values[] = "" . $_POST["IdMarca"] . "";
        $productos->values[] = $Idfile;

        $productos->insertProducto();

        echo '<script>location.replace("index.php?page=ProductosAdmin&ins=Ok");</script>';

    } else if ($action === 'update') {

        foreach ($dtviewproducto as $temp):
            $IdArchivoProd = $temp["IdArchivo"];
        endforeach;

        $productos->values[] = "" . $_POST["NombreProducto"] . "";
        $productos->values[] = "" . $_POST["Descripcion"] . "";
        $productos->values[] = "" . $_POST["IdTProducto"] . "";
        $productos->values[] = "" . $_POST["IdMarca"] . "";

        if($Idfile !== "NULL"){
            $productos->values[] = $Idfile;
        }else{
            $productos->values[] = $IdArchivoProd;
        }

        $productos->updateProducto($IdProducto);

        echo '<script>location.replace("index.php?page=ProductosAdmin&upd=Ok");</script>';

    } elseif ($action === 'delete') {

        foreach ($dtviewproducto as $temp):
            $IdArchvioProd = $temp["IdArchivo"];
        endforeach;

        $productos->deleteProducto($IdProducto);

        if (isset($IdArchvioProd)) {
            $archivo->deleteArchivo($IdArchvioProd);
        }
        echo '<script>location.replace("index.php?page=ProductosAdmin&del=Ok");</script>';
    }
}
