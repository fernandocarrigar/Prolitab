<?php

require_once ("modelos/model_archivosfisicos.php");

if (isset($_GET['ins'])) {
    if ($_GET['ins'] == "Ok") {
        echo '<script>alert("Se inserto correctamente");</script>';
    }
} elseif (isset($_GET['upd'])) {
    if ($_GET['upd'] == "Ok") {
        echo '<script>alert("Se actualizo correctamente");</script>';
    }
} elseif (isset($_GET['del'])) {
    if ($_GET['del'] == "Ok") {
        echo '<script>alert("Se elimino correctamente");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Archivos descargables</title>
</head>

<body class="TiposProductos-body">
    <div class="TiposProductos-container">
        <h1 class="TiposProductos-heading">Archivos descargables</h1>
        <a href="index.php?page=ArchivosCarga" class="btn btn-success btn-success-TiposProductos">
            Agregar un nuevo archivo
        </a>
        <div class="table-responsive table-responsive-TiposProductos">
            <table class="table table-TiposProductos table-hover table-hover-TiposProductos table-bordered">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Archivos</th>
                        <th scope="col">Descargar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($ArchivosDescargables) && !empty($ArchivosDescargables)) {
                        foreach ($ArchivosDescargables as $row):
                            $arrayName = explode("/",$row);
                            $Name = $arrayName[(count($arrayName) - 1)];
                            ?>
                            <tr class="text-center">
                                <td><?= $Name ?></td>
                                <td><a href="<?= $row ?>" class="btn btn-primary btn-primary-TiposProductos btn-sm" download>Descargar</a></td>
                                <td><a href="index.php?page=ArchivosAdmin&file=delete&a=<?= $Name ?>"
                                        class="btn btn-danger btn-danger-TiposProductos btn-sm">Borrar</a></td>
                            </tr>
                            <?php
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>