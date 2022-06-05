<?php
require_once __DIR__ . '/autoload.php';

use \functions\functions as func;

$sesion = new func();

$sesion->checkSession();
?>

<!DOCTYPE html>
<html lang="es">

    <?php
    require_once 'head.php';
    ?>

    <body>
        <div class="container-flex">

<?php
require_once 'header.php';
?>

            <div class="hambMenu" id="hambMenu">
                <a class="itemMenu pag_actual" href="index.php">Inicio</a>
                <a class="itemMenu" href="panaderia.php">Panaderia</a>
                <a class="itemMenu" href="pasteleria.php">Pasteleria</a>
                <a class="itemMenu" href="blog.php">Blog</a>
                <a class="itemMenu" id="item-final-menu" href="contacto.php">Contacto</a>
            </div>
        </div>

        <div class="slider">
            <ul class="ul_slider">
                <li class="li_slider">
                    <img src="images/banner-1.webp" class="img_slider" />
                </li>
                <li class="li_slider">
                    <img src="images/banner-2.webp" class="img_slider" />
                </li>
                <li class="li_slider">
                    <img src="images/banner-3.webp" class="img_slider" />
                </li>
            </ul>
        </div>

        <div class="texto_index">
            <h1>Nuestra Historia</h1>
            <p class="p_index"><b>Nacimos durante el estado de alarma</b>, sabemos que fue un momento duro para todos, pero
                nosotros
                nos pasamos toda la cuarentena en casa haciendo postres cuando se nos ocurrió lanzar Panaderías M.L., <b>queremos
                    reinventar la forma de estar más cerca de vosotros<b> sin estarlo. Todo ello cumpliendo las más estrictas normas
                        de seguridad para
                        que recibáis todos nuestros producto con la mejor calidad y libre de cualquier agente infeccioso.</p>
                        <p class="p_index">En Panaderias M.L. <b>tenemos una gran pasión por nuestro pan, repostería y vuestra
                                felicidad</b>. Todos
                            los días de nuestra tienda física y online sale un cliente satisfecho.</p>
                        </div>

<?php
require_once 'footer.php';
?>

                        <!-- JavaScript Bundle with Popper.js -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
                                integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"
                        crossorigin="anonymous"></script>
                        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

                        <script src="js/responsive_header.js"></script>


                        </body>

                        </html>