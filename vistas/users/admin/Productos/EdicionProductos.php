<?php
require_once ("modelos/model_productos.php");
require_once ("modelos/model_tiposproductos.php");
require_once ("modelos/model_marcas.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Edición de Productos</title>
</head>

<body>
    <div class="edicionProd-container container">
        <h1 class="text-center edicionProd-heading">Edición de productos</h1>

        <?php
        $Id = "";
        $Nombre = "";
        $Descripcion = "";
        $IdTProducto = "";
        $IdMarca = "";
        $TpFilePrd = "";
        $FilePrd = "";
        $IdFilePrd = "";

        if (isset($dtviewproducto)) {
            foreach ($dtviewproducto as $row):
                $Id = $row["IdProducto"] ?? "";
                $Nombre = $row["NombreProducto"] ?? "";
                $Descripcion = $row["Descripcion"] ?? "";
                $IdTProducto = $row["IdTProducto"] ?? "";
                $IdMarca = $row["IdMarca"] ?? "";
                $TpFilePrd = $row["Tipo"] ?? "";
                $FilePrd = $row["Archivo"] ?? "";
                $IdFilePrd = $row["IdArchivo"] ?? "";
            endforeach;
        }

        $actionP = "";
        $actionF = "";
        $actionP = (!empty($Id) && isset($Id)) ? "update" : "insert";
        $actionF = (!empty($IdFilePrd) && isset($IdFilePrd)) ? "update" : "insert";

        $action = "index.php?page=ProductosAdmin&actionprod=$actionP&actionfile=$actionF";
        ?>
        <form method="post" action="<?php echo $action ?>" enctype="multipart/form-data">
            <div class="form-group form-group-custom">
                <label for="Archivo">Imagen del Producto:</label>
                <input id="Archivo" name="Archivo" class="form-control form-control-custom form-control-lg" type="file"
                    onchange="myimg()" />
                <img id="muestra" src="data:<?php echo $TpFilePrd ?>;base64,<?php echo (base64_encode($FilePrd)) ?>"
                    alt="Imagen seleccionada" class="img-thumbnail img-thumbnailProd" />
            </div>
            <div class="form-floating form-group form-group-custom">
                <input type="text" name="NombreProducto" class="form-control form-control-custom" id="NombreProducto"
                    placeholder="Nombre del producto" value="<?php echo $Nombre ?>" required>
                <label for="NombreProducto">Nombre del Producto</label>
            </div>

            <div class="form-floating form-group form-group-custom">
                <input type="text" class="form-control form-control-custom" id="Descripcion" name="Descripcion"
                    placeholder="Detalles o Descripción del Producto" value="<?php echo $Descripcion ?>" required>
                <label for="Descripcion">Detalles o Descripción del Producto</label>
            </div>

            <div class="form-group form-floating form-group-custom">
                <select name="IdTProducto" id="IdTProducto" placeholder="SELECCIONE UN TIPO DE PRODUCTO"
                    class="form-control form-control-custom form-control-lg" required>
                    <option value="NULL" <?= !empty($IdTProducto) ? "hidden disabled" : "" ?>>NINGUNO</option>
                    <?php
                    foreach ($dttipos as $row):
                        ?>
                        <option value="<?= $row['IdTProducto'] ?>"><?= $row['Tipo'] ?></option>
                        <?php
                    endforeach;
                    ?>

                </select>
                <label>Tipo de producto</label>
            </div>

            <div class="form-group form-floating form-group-custom">
                <select name="IdMarca" id="IdMarca" placeholder="SELECCIONE UNA MARCA"
                    class="form-control form-control-custom form-control-lg" required>
                    <option value="NULL" <?= !empty($IdMarca) ? "hidden disabled" : "" ?>>NINGUNA</option>
                    <?php
                    foreach ($dtmarcasview as $row):
                        ?>
                        <option value="<?= $row['IdMarca'] ?>"><?= $row['NombreMarca'] ?></option>
                        <?php
                    endforeach;
                    ?>

                </select>
                <label>Marca</label>
            </div>

            <div class="z-1n opacity-0">
                <input id="IdProducto" name="IdProducto" value="<?php echo $Id ?>" hidden readonly />
                <input id="IdArchivo" name="IdArchivo" value="<?php echo $IdFilePrd ?>" hidden readonly />
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=ProductosAdmin" class="btn btn-success btn-success-custom">Volver</a>
            </div>
        </form>
    </div>
    <script>
        function myimg() {
            var input = document.getElementById('Archivo');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('muestra').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            valSel('IdTProducto', <?php echo $IdTProducto ?>);
            valSel('IdMarca', <?php echo $IdMarca ?>);
        });
    </script>
</body>

</html>