<?php
require_once ('modelos/model_archivosfisicos.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Web | Carga de Archivos</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Carga de archivos descargables</h1>
        <form action="index.php?page=ArchivosAdmin&file=upload" method="post" enctype="multipart/form-data">
            <div class="div-form-upload">
                <div class="upload-files">
                    <label class="label-files">
                        <input class="input-upload" id="Archivos" name="Archivos[]" type="file" multiple />
                        <span>Selecciona un archivo</span>
                        El nombre de los archivos debe ser legible
                    </label>
                    <button class="btn-upload" type="submit">Cargar</button>
                </div>
                <a href="index.php?page=ArchivosAdmin" class="back-button">Volver</a>
            </div>
        </form>
    </div>
</body>

</html>