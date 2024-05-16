﻿<!-- Navbar lateral start-->

<?php
require_once("modelos/model_publicaciones.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Edición Imagen del Carrusel</title>
</head>

<body>
    <div class="container edicionCarr-container">
    <?php
        $Id = "";
        $Clave = "Carrusel";
        $Titulo = "NULL"; 
        $Descripcion = ""; 
        $TpFilePub = "";
        $FilePub = "";
        $IdFile = "";

        if (isset($dtpubwhere)) {
            foreach ($dtpubwhere as $row):
                $Id = $row["IdPublicacion"];
                $Clave = $row["Clave"];
                $Titulo = $row["Titulo"];
                $Descripcion = $row["DescripcionPublicacion"];
                $TpFilePub = $row["TipoArchivoPub"];
                $FilePub = $row["ArchivoPub"];
                $IdFile = $row["IdArchivo"];
            endforeach;
        }

        $actionP = "";
        $actionF = "";
        $actionP = (!empty($Id) && isset($Id)) ? "update" : "insert";
        $actionF = (!empty($IdFile) && isset($IdFile)) ? "update" : "insert";

        $action = "index.php?page=ImgCarruselAdmin&actionpub=$actionP&actionfile=$actionF";
        ?>
        <form method="post" action="<?php echo $action ?>" enctype="multipart/form-data">
            <h3 class="edicionCarr-heading">Imagen del Carrusel</h3>
            <div class="form-group form-groupCustom">
                <input id="Archivo" name="Archivo" class="form-control form-control-lg customForm-control-lg" type="file" onchange="myimg()" required />
            </div>
            <div class="card edicionCarr-card">
                <img id="muestra" src="data:<?php echo $TpFilePub ?>;base64,<?php echo (base64_encode($FilePub)) ?>" 
                alt="<?php echo !empty($Descripcion) && isset($Descripcion) ? $Descripcion : "Aqui se muestra la imagen seleccionada" ?>" class="img-thumbnail" style="max-width:400px; max-height:300px;" />
            </div>
            <div class="z-1n opacity-0">
                <input id="CampoKey" name="CampoKey" value="<?php echo $Clave ?>" hidden readonly />
                <input id="Titulo" name="Titulo" value="<?php echo $Titulo ?>" hidden readonly />
                <input id="Descripcion" name="Descripcion" value="<?php echo $Descripcion ?>" hidden readonly />
                <input id="IdPublicacion" name="IdPublicacion" value="<?php echo $Id ?>" hidden readonly />
                <input id="IdArchivo" name="IdArchivo" value="<?php echo $IdFile ?>" hidden readonly />
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-primary btn-success-custom">Enviar</button>
                <a href="index.php?page=ImgCarruselAdmin" class="btn btn-primary btn-success-custom">Volver</a>
            </div>
        </form>
    </div>
    <script>
        function myimg() {
            var input = document.getElementById('Archivo');
            var fileReader = new FileReader();
            fileReader.readAsDataURL(input.files[0]);
            fileReader.onload = function(e) {
                document.getElementById('muestra').src = e.target.result;
            };
        }
    </script>
</body>

</html>