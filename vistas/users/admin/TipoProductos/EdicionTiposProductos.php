<?php
    include_once('modelos/model_tiposproductos.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Funciones</title>
    <style>

    </style>
</head>

<body>
    <div class="edicionProd-container container">
        <h1 class="text-center edicionProd-heading">Tipos de productos</h1>
        <?php
        $Id = NULL;
        $Tipo = "";
        if (!empty($dttipowhere)) {
            foreach ($dttipowhere as $row):
                $Id = $row['IdTProducto'];
                $Tipo = $row['Tipo'];
            endforeach;
        }

        $action = !empty($Id) ? "update" : "insert";

        ?>
        <form method="post" action="index.php?page=EdicionTProductos&actiontp=<?= $action ?>" enctype="multipart/form-data" id="formulario">
            <div id="inputContainer">

                <div class="input-group function-input-group">
                    <div class="form-floating form-group form-group-custom function-form-group-custom">
                        <input type="text" name="Tipo[]" class="form-control form-control-custom function-form-control-custom function-form" value="<?= $Tipo ?>" required>
                        <label class="function-label">Tipo de Producto</label>
                    </div>
                    <button type="button" onclick="eliminarInput(this)" class="contacto-button function-delete-btn">Eliminar</button>
                </div>
            </div>
            <div style="display: none;">
                <input name="IdTProducto" value="<?= $Id ?>" hidden readonly />
            </div>
            <div class="button-container">
                <button type="button" onclick="agregarInput()" class="function-btn">Agregar</button>
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=TiposProductosAdmin" class="btn btn-success btn-success-custom">Volver</a>
            </div>
        </form>
    </div>

    <script>
        function agregarInput() {
            var container = document.getElementById('inputContainer');
            var newInputGroup = document.createElement('div');
            newInputGroup.className = 'input-group function-input-group';
            newInputGroup.innerHTML = `
                <div class="form-floating form-group form-group-custom function-form-group-custom">
                    <input type="text" name="Tipo[]" class="form-control form-control-custom function-form-control-custom function-form" value="" required>
                    <label class="function-label">Tipo de Producto</label>
                </div>
                <button type="button" onclick="eliminarInput(this)" class="contacto-button function-delete-btn">Eliminar</button>
            `;
            container.appendChild(newInputGroup);
        }

        function eliminarInput(btn) {
            var container = document.getElementById('inputContainer');
            var inputGroup = btn.parentElement;
            container.removeChild(inputGroup);
        }
    </script>
</body>

</html>