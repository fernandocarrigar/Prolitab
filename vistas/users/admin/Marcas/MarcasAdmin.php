<?php

require_once("modelos/model_marcas.php");

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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Web | Marcas</title>
</head>

<body>
    <div class="carruselImg-container container shadow justify-content-center bg-dark-subtle mt-4">
        <h1 class="text-center carruselImg-heading">Marcas</h1>
        <a href="index.php?page=EdicionMarca" class="btn btn-primary service-btn btn-carruselImg btn-lg d-relative">
            Agregar un nueva marca
        </a>

        <div class="container mt-3 p-3 bg-white overflow-auto table-scroll rounded" style="max-height:600px;">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php
                foreach ($dtmarcasview as $rows) {
                    echo '<div class="col">';
                    echo '<div class="card service-card carruselImg-card h-100">';
                    echo '<img src="data:' . $rows['Tipo'] . ';base64,' . base64_encode($rows['Archivo']) . '" alt="' . $rows['NombreMarca'] . '" class="card-img-top service-card-img-top" />';
                    echo '<div class="card-body card-body-bg service-card-body">';
                    echo '<h5 class="card-title service-card-title">' . $rows['NombreMarca'] . '</h5>';
                    echo '<div class="button-container service-button-container">';
                    echo '<a href="index.php?page=EdicionMarca&IdMarca=' . $rows['IdMarca'] . '" class="btn service-btn btn-success btn-success-bg btn-sm">Actualizar</a>';
                    echo '<a href="index.php?page=MarcasAdmin&actionmar=delete&IdMarca=' . $rows['IdMarca'] . '" class="btn service-btn btn-danger btn-danger-bg btn-sm">Eliminar</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>