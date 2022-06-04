<?php
require_once __DIR__ . '/autoload.php'; 
        
use functions\Functions as func; 	
        
$sesion = new func(); 
        
$sesion->checkSession(); 


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0" />
    <title>Post</title>
    <!-- Estilos página-->
    <link rel="stylesheet" href="css/panaderia_v2.css" />
    <link rel="stylesheet" href="css/pagina_panaderia.css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous" />
    <!-- Iconos Font Awesome--->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
</head>

<body>

    <div class="container-flex">
        <?php
    require_once 'header.php';
     ?>

        <div class="hambMenu" id="hambMenu">
            <a class="itemMenu" href="index.php">Inicio</a>
            <a class="itemMenu" href="panaderia.php">Panaderia</a>
            <a class="itemMenu" href="pasteleria.php">Pasteleria</a>
            <a class="itemMenu pag_actual" href="blog.php">Blog</a>
            <a class="itemMenu" id="desplegable" href="#">Próximamente</a>
            <a class="itemMenu item-desplegable submenu btn disabled" href="" hidden>Tarjetas regalo</a>
            <a class="itemMenu item-desplegable submenu btn disabled" href="" hidden>Pasteles con tu cara</a>
            <a class="itemMenu" id="item-final-menu" href="contacto.php">Contacto</a>
        </div>
    </div>

    <div class="container mt-5">

        <section class="banner-section mt-5">
            <img class="post-img"
                src="https://images.unsplash.com/photo-1576422558070-ae29d728947e?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1500&q=80" />
        </section>

        <h1 class="display-3 text-center my-2">Mensaje navideño 2020</h1>

        <section class="py-3 list-inline justify-content-center text-center">
            <img src="images/author.png" class="autor-foto" />
            <h1 class="autor_nombre display-6">Juan López</h1>
        </section>

        <div class="row">

            <div class="col">
                -<input type="range" id="barra-progreso" min="0" step="50" max="100" default="0" value="0">+
            </div>
            <div class="col align-self-end search">
                <input type="text" class="input_busqueda" name="searchBox" id="searchBox" placeholder="Buscar...">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
        </div>

        <p class="mt-4 texto_post justify-content-center text-justify">
            Las navidades se acercan y con ellos nuestros sentimientos de estar más cerca de nuestros seres queridos,
            pero no tenemos que bajar la guardia sobre todos en estos momentos que están siendo los más duros. Desde
            Panaderías M.L. con el fin de haceros la vida un poco más fácil hemos decidido haceros una oferta especial
            este año.
        </p>

        <h1 class="display-5 mb-3 mt-2">DESCUENTOS DE HASTA UN 50%</h1>

        <p class="my-4 texto_post justify-content-center text-justify">Descuentos en tiempos de crisis? Pues si, porque podemos
            ofrecer la mejor calidad de
            siempre a
            todos nuestros
            clientes. Este año tendremos muchos dulces, postres y con entrega a domicilio para que no tengáis que
            desplazaros hasta la tienda. Os dejamos algunas imagenes de algunos de nuestros productos para estas
            fiestas:</p>

        <div id="carouselControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 post-img" src="images/carousel/1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 post-img" src="images/carousel/2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 post-img" src="images/carousel/3.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <p class="my-4 texto_post justify-content-center text-justify">Desde Panaderias M.L. os deseamos unas felices fiestas y un
            mejor año 2021 para todos nuestros cliente y no nos cansaremos de deciros <b>GRACIAS, GRACIAS y MUCHAS GRACIAS</b> por confiar en nosotros en
            los momentos más duros.</p>

    </div>



    <?php
  require_once 'footer.php';
 ?>

    <!-- JavaScript Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-highlight@3.5.0/jquery.highlight.min.js"></script>

    <script type="text/javascript">
        /*Función que le hace highlight al texto que buscamos en el buscador*/
        $(function () {
            $('.input_busqueda').bind("keypress", (evento) => {

                var elementoBuscar = $('.input_busqueda').val() + evento.key;

                $('.texto_post').unhighlight(); // Eliminamos el highlight
                $('.texto_post').highlight(elementoBuscar); // Destacamos el texto si es correcto
            });
        });
    </script>
    <!-- Javascript Header -->
    <script src="js/responsive_header.js"></script>
    <script src="js/functions.js"></script>
</body>


</html>