<?php

require_once("recursos/config/db.php");
require_once("controladores/controller_clientes.php");
require_once("modelos/model_archivos.php");


$cliente = new Clientes();
$cliente->setTable("Clientes");
$cliente->setView('view_clientes');

$cliente->setKey('IdCliente');

$cliente->setColumns('NombreCliente');
$cliente->setColumns('IdArchivo');

$cliente->setColumnsView('NombreCliente');

$IdCliente = $_GET['IdCliente'] ?? $_POST['IdCliente'] ?? null;

if (isset($IdCliente) && !empty($IdCliente)) {
    // $dtclientewhere = $cliente->getWhere($IdCliente);
    $dtviewcliente = $cliente->getWhereview($IdCliente);
} else {
    $IdCliente = null;
    $dtclientewhere = null;
    $dtviewcliente = null;

    // if (!empty($_GET['page']) && $_GET['page'] == "Temas") {
    //     $dtmarcasview = !empty($_POST['filter']) ? $cliente->getWhereFilter($_POST['filter']) : $cliente->getView();
    //     $filter = $_POST['filter'] ?? "";
    // } else {
        $dtclientesview = $cliente->getView();
    // }
}


// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actioncli'])) && (isset($_GET['actioncli']))) {
    $actioncli = $_GET['actioncli'];

    if ($actioncli === 'insert') {

        $cliente->values[] = "'" . $_POST['NombreCliente'] . "'";
        $cliente->values[] = $Idfile;

        $cliente->insertCliente();

        echo '<script>location.replace("index.php?page=ClientesAdmin&ins=Ok");</script>';

    } elseif ($actioncli === 'update') {

        foreach ($dtviewcliente as $rowid):
            $IdArchivoC = $rowid['IdArchivo'];
        endforeach;

        $cliente->values[] = "" . $_POST['NombreCliente'] . "";

        if($Idfile !== "NULL"){
            $cliente->values[] = $Idfile;
        }else{
            $cliente->values[] = $IdArchivoC;
        }

        $cliente->updateCliente($IdCliente);

        echo '<script>location.replace("index.php?page=ClientesAdmin&upd=Ok");</script>';

    } elseif ($actioncli === 'delete') {
        foreach ($dtviewcliente as $rowid):
            $IdArchivoC = $rowid['IdArchivo'];
        endforeach;

        $cliente->deleteCliente($IdCliente);

        if (isset($IdArchivoC)) {
            $archivo->deleteArchivo($IdArchivoC);
        }

        echo '<script>location.replace("index.php?page=ClientesAdmin&del=Ok");</script>';
    }
}