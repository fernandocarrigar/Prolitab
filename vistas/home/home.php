<?php
include_once('modelos/model_publicaciones.php');
include_once('modelos/model_marcas.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prolitab | Inicio</title>
</head>

<body>

    <header>
        <h1 class="text-center">Inicio</h1>
    </header>

    <section>
        <div class="home-slider">
            <?php
            $cuenta = 0;
            if(isset($dtcarrusel)){
            foreach($dtcarrusel as $row):
                ?>
            <div class="home-slide <?php echo ($cuenta === 0 ? "active" : "" );?>">
                <img src="data:<?= $row['TipoArchivoPub'] ?>;base64,<?= (base64_encode($row['ArchivoPub'])) ?>" alt="Publicidad">
            </div>
            <?php
            $cuenta++;
            endforeach;
        }
            ?>
            <!-- <div class="home-slide">
                <img src="https://talesoflumin.com/wp-content/uploads/2021/01/Featured-Images-Fallen-Order.png" alt="Publicidad 2">
            </div>
            <div class="home-slide">
                <img src="https://images3.alphacoders.com/134/thumb-1920-1348939.png" alt="Publicidad 3">
            </div>
            <div class="home-slide">
                <img src="https://placehold.co/1923x700" alt="Publicidad 4">
            </div>
            <div class="home-slide">
                <img src="https://placehold.co/1924x700" alt="Publicidad 5">
            </div>
            <div class="home-slide">
                <img src="https://placehold.co/1925x700" alt="Publicidad 6">
            </div>
            <div class="home-slide">
                <img src="https://placehold.co/1926x700" alt="Publicidad 7">
            </div>
            <div class="home-slide">
                <img src="https://placehold.co/1927x700" alt="Publicidad 8">
            </div>
            <div class="home-slide">
                <img src="https://placehold.co/1928x700" alt="Publicidad 9">
            </div>
            <div class="home-slide">
                <img src="https://placehold.co/1929x700" alt="Publicidad 10">
            </div>
            <div class="home-slide">
                <img src="https://placehold.co/1930x700" alt="Publicidad 3">
            </div> -->
            <a class="home-prev">&#10094;</a>
            <a class="home-next">&#10095;</a>
        </div>
    </section>

    <section>
        <div class="carousel-secondary mt-3">
            <div class="carousel-secondary-items">
                <!-- Añade los elementos del carrusel aquí -->
                <?php
                foreach($dtmarcasview as $row):
                ?>
                <div class="carousel-secondary-item"><img src="data:<?= $row['Tipo'] ?>;base64,<?= (base64_encode($row['Archivo'])) ?>" alt="<?= $row['NombreMarca']?>"></div>
                <?php
                endforeach;
                ?>
                <!-- <div class="carousel-secondary-item"><img src="https://via.placeholder.com/300x200" alt="Elemento 2"></div>
                <div class="carousel-secondary-item"><img src="https://via.placeholder.com/300x200" alt="Elemento 3"></div>
                <div class="carousel-secondary-item"><img src="https://via.placeholder.com/300x200" alt="Elemento 4"></div>
                <div class="carousel-secondary-item"><img src="https://via.placeholder.com/300x200" alt="Elemento 5"></div>
                <div class="carousel-secondary-item"><img src="https://via.placeholder.com/300x200" alt="Elemento 6"></div>
                <div class="carousel-secondary-item"><img src="https://via.placeholder.com/300x200" alt="Elemento 7"></div>
                <div class="carousel-secondary-item"><img src="https://via.placeholder.com/300x200" alt="Elemento 8"></div> -->
            </div>
            <button class="carousel-secondary-control carousel-secondary-prev">←</button>
            <button class="carousel-secondary-control carousel-secondary-next">→</button>
        </div>
    </section>

</body>