<?php
include_once ('modelos/model_productos.php');
?>

<head>
    <title>Prolitab | Productos</title>
</head>

<body class="product-body">

    <form action="index.php?page=Productos" method="post">
        <header class="search-bar">
            <input type="text" id="search-input" name="filter" value="<?= $filter ?? "" ?>" placeholder="Buscar productos...">
            <button class="product-btn" type="submit">Buscar</button>
        </header>
    </form>

    <main id="products-container">
        <!-- Product Cards -->
        <?php
        foreach ($dtprodsview as $row):
            ?>
            <div class="product-item">
                <img src="data:<?= $row['Tipo'] ?>;base64,<?= (base64_encode($row['Archivo'])) ?>"
                    alt="<?= $row['NombreProducto'] ?>" class="product-image">
                <h3><?= $row['NombreProducto'] ?></h3>
                <p class="overflow-hidden" style="max-height:30px;"><?= $row['Descripcion'] ?></p>
                <div>
                    <span class="text-muted ms-4">Tipo de producto: <?= $row['TipoProducto'] ?? "" ?></span><br>
                    <span class="text-muted ms-4">Marca: <?= $row['NombreMarca'] ?? "" ?></span>
                </div>
            </div>
            <?php
        endforeach;
        ?>
        <!-- <div class="product-item">
            <img src="https://placehold.co/400x400" alt="Producto 2" class="product-image">
            <h3>Producto 2</h3>
            <p>Descripción del producto 2, una descripción más larga que la del producto uno.</p>
        </div>
        <div class="product-item">
            <img src="https://placehold.co/400x400" alt="Producto 3" class="product-image">
            <h3>Producto 3</h3>
            <p>Descripción del producto 3, con detalles adicionales sobre el producto.</p>
        </div>
        <div class="product-item">
            <img src="https://placehold.co/400x400" alt="Producto 4" class="product-image">
            <h3>Producto 4</h3>
            <p>Descripción del producto 4, descripción estándar del producto.</p>
        </div>
        <div class="product-item">
            <img src="https://placehold.co/400x400" alt="Producto 5" class="product-image">
            <h3>Producto 5</h3>
            <p>Descripción del producto 5, descripción estándar del producto.</p>
        </div> -->
    </main>

    <footer class="product-footer">
        <button class="product-btn previous" onclick="previousPage()">« Anterior</button>
        <span id="page-info"></span>
        <button class="product-btn next" onclick="nextPage()">Siguiente »</button>
    </footer>
</body>