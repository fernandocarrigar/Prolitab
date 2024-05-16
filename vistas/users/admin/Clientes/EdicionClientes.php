<?php
require_once("modelos/model_clientes.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Editar Clientes</title>
</head>

<body class="EdicionMarcas-body">
    <div class="container EdicionMarcas-container">
        <h1 class="text-center EdicionMarcas-heading">Edición de clientes</h1>

        <?php
        $Id = "";
        $Nombre = "";
        $TpFileCli = "";
        $FileCli = "";
        $IdFile = "";

        if (isset($dtviewcliente)) {
            foreach ($dtviewcliente as $row) :
                $Id = $row["IdCliente"];
                $Nombre = $row["NombreCliente"];
                $TpFileMar = $row["Tipo"];
                $FileMar = $row["Archivo"];
                $IdFile = $row["IdArchivo"];
            endforeach;
        }

        $actionM = "";
        $actionF = "";
        $actionM = (!empty($Id) && isset($Id)) ? "update" : "insert";
        $actionF = (!empty($IdFile) && isset($IdFile)) ? "update" : "insert";

        $action = "index.php?page=ClientesAdmin&actioncli=$actionM&actionfile=$actionF";
        $required = (!empty($Id) && isset($Id)) ? "" : "required";
        ?>

        <form method="post" action="<?= $action ?>" enctype="multipart/form-data">
            <div class="form-group form-group-EdicionMarcas">
                <input id="Archivo" name="Archivo" class="form-control form-control-EdicionMarcas form-control-lg" type="file" onchange="myimg()" <?= $required ?> />
                <img id="muestra" src="data:<?= $TpFileMar ?>;base64,<?php echo (base64_encode($FileMar)) ?>" alt="Imagen seleccionada" class="img-thumbnail img-thumbnail-EdicionMarcas" />
            </div>
            <div class="form-floating m-3">
                <input id="NombreCliente" name="NombreCliente" value="<?= $Nombre ?>" class="form-control form-control-EdicionMarcas" type="text" placeholder="Nombre del cliente" required />
                <label for="NombreCliente">Nombre del cliente</label>
            </div>

            <div style="display: none;">
                <input id="IdCliente" name="IdCliente" value="<?php echo $Id ?>" hidden readonly />
                <input id="IdArchivo" name="IdArchivo" value="<?php echo $IdFile ?>" hidden readonly />
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=ClientesAdmin" class="btn btn-success btn-success-custom">Volver</a>
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