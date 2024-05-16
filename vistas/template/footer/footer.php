<?php
require_once ('modelos/model_configuraciones.php');

$Direccion = "";
$CodigoPostal = "";
$Ciudad = "";
$Estado = "";
$Telefono = "";
$Correo = "";
$Facebook = "";
$Instagram = "";
$Whatsapp = "";
$Youtube = "";

foreach ($dtcontactos as $row):
    switch ($row["CampoKey"]) {
        case "Direccion":
            $Direccion = $row["Descripcion"] ?? "";
            break;
        case "CodigoPostal":
            $CodigoPostal = $row["Descripcion"] ?? "";
            break;
        case "Ciudad":
            $Ciudad = $row["Descripcion"] ?? "";
            break;
        case "Estado":
            $Estado = $row["Descripcion"] ?? "";
            break;
        case "Telefono":
            $Telefono = $row["Descripcion"] ?? "";
            break;
        case "Correo":
            $Correo = $row["Descripcion"] ?? "";
            break;
        case "Facebook":
            $Facebook = $row["Descripcion"] ?? "";
            break;
        case "Instagram":
            $Instagram = $row["Descripcion"] ?? "";
            break;
        case "Youtube":
            $Youtube = $row["Descripcion"] ?? "";
            break;
        case "Whatsapp":
            $Whatsapp = $row["Descripcion"] ?? "";
            break;
    }
endforeach;

$contactoFooter = (!empty($Telefono) || !empty($Correo) || !empty($Whatsapp));
$enlacesFooter = (!empty($Facebook) || !empty($Instagram) || !empty($Youtube));
$direccionFooter = (!empty($Ciudad) || !empty($CodigoPostal) || !empty($Direccion) || !empty($Estado));
$dirfull = $direccionFooter ? implode(", <br>", $valores = [$Direccion, $CodigoPostal, $Ciudad, $Estado]) : "";
?>
<footer class="footer mt-5">
    <div class="footer-container">
        <div class="footer-row">
            <?php
            if ($direccionFooter) {
                ?>
                <div class="footer-col">
                    <h4 class="footer-heading">Dirección</h4>
                    <ul class="footer-list">
                        <li>
                            <a target="_blank" href="" class="footer-link">
                                <?= $dirfull ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <?php
            }

            if ($contactoFooter) {
                ?>
                <div class="footer-col">
                    <h4 class="footer-heading">Contacto</h4>
                    <ul class="footer-list">
                        <li><a href="tel:+<?= $Telefono ?>" class="footer-link">Teléfono: <?= $Telefono ?></a></li>
                        <li><a href="https://wa.me/<?= $Whatsapp ?>" class="footer-link">WhatsApp: <?= $Whatsapp ?></a></li>
                        <li><a href="mailto:<?= $Correo ?>" class="footer-link">Email: <?= $Correo ?></a></li>
                    </ul>
                </div>
            <?php
            }
            ?>
            <div class="footer-col">
                <h4 class="footer-heading">Enlaces</h4>
                <ul class="footer-list">
                    <li><a href="index.php" class="footer-link">Inicio</a></li>
                    <li><a href="index.php?page=Nosotros" class="footer-link">Nosotros</a></li>
                    <li><a href="index.php?page=Productos" class="footer-link">Productos</a></li>
                </ul>
            </div>
            <?php
            if($enlacesFooter){
            ?>
            <div class="footer-col">
                <h4 class="footer-heading">Redes</h4>
                <div class="footer-social">
                    <a href="#" class="footer-social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="footer-social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="footer-social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="footer-social-link"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</footer>

<script type="text/javascript" src="recursos/js/mobile-btn.js"></script>
<script type="text/javascript" src="recursos/js/home-slider.js"></script>
<script type="text/javascript" src="recursos/js/carrusel-secundario.js"></script>
<script type="text/javascript" src="recursos/js/sidebar-admin.js"></script>
<script type="text/javascript" src="recursos/js/inputs-autofill.js"></script>