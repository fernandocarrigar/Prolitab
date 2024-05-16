<?php
require_once("modelos/model_temas.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Editar Servicio</title>
</head>

<body>
    <div class="edicionProd-container container">
        <!-- Título de la vista -->
        <h1 class="edicionProd-heading text-center">Edición de Tema</h1>

        <?php
        $Id = "";
        $Titulo = "";
        $Descripcion = "";
        $TpFileTem = "";
        $FileTem = "";
        $IdFile = "";

        if (isset($dtviewtema)) {
            foreach ($dtviewtema as $row) :
                $Id = $row["IdTema"];
                $Titulo = $row["Titulo"];
                $Descripcion = $row["Descripcion"];
                $TpFileTem = $row["Tipo"];
                $FileTem = $row["Archivo"];
                $IdFile = $row["IdArchivo"];
            endforeach;
        }

        $actionT = "";
        $actionF = "";
        $actionT = (!empty($Id) && isset($Id)) ? "update" : "insert";
        $actionF = (!empty($IdFile) && isset($IdFile)) ? "update" : "insert";

        $action = "index.php?page=TemasAdmin&actiontem=$actionT&actionfile=$actionF";
        $required = (!empty($Id) && isset($Id)) ? "" : "required";
        ?>
        <form method="post" action="<?php echo $action ?>" enctype="multipart/form-data">
            <div class="form-group form-group-custom">
                <input id="Archivo" name="Archivo" class="form-control form-control-custom form-control-lg" type="file" onchange="myimg()" />
            </div>
            <div class="form-floating form-group-custom">
                <input id="Titulo" name="Titulo" class="form-control form-control-custom" value="<?= $Titulo ?>" type="text" placeholder="Titulo del tema" <?= $required ?> />
                <label for="Titulo">Titulo del tema</label>
            </div>
            <div class="form-floating form-group form-group-custom">
                <textarea id="Descripcion" name="Descripcion" class="form-control form-control-custom" rows="5" placeholder="Inserte la descripción del tema" style="resize: none; min-height: 90px"><?php echo $Descripcion ?></textarea>
                <label for="Descripcion">Inserte la descripción del tema</label>
            </div>

            <div style="display: none;">
                <input id="IdTema" name="IdTema" value="<?php echo $Id ?>" hidden readonly />
                <input id="IdArchivo" name="IdArchivo" value="<?php echo $IdFile ?>" hidden readonly />
            </div>

            <div class="form-group form-group-custom">
                <img class="img-thumbnail img-thumbnailProd" id="muestra" src="data:<?php echo $TpFileTem ?>;base64,<?php echo (base64_encode($FileTem)) ?>" alt="Imagen seleccionada" />
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=TemasAdmin" class="btn btn-success btn-success-custom">Volver</a>
            </div>
        </form>
    </div>

    <script>
        function myimg() {
            var input = document.getElementById('Archivo');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('muestra').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>