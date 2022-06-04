<?php
require_once __DIR__ . '/autoload.php'; 
        
use functions\functions as func; 	
        
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
    <title>Contacto</title>
    <!-- Estilos página-->
    <link rel="stylesheet" href="css/panaderia_v2.css" />
    <link rel="stylesheet" href="css/pagina_panaderia.css" />

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous" />
    <!-- Iconos Font Awesome--->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <!-- CSS Styles Leaflet-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
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
			<a class="itemMenu" href="blog.php">Blog</a>
			<a class="itemMenu" id="desplegable" href="#">Próximamente</a>
			<a class="itemMenu item-desplegable submenu btn disabled" href="" hidden>Tarjetas regalo</a>
			<a class="itemMenu item-desplegable submenu btn disabled" href="" hidden>Pasteles con tu cara</a>
			<a class="itemMenu pag_actual" id="item-final-menu" href="contacto.php">Contacto</a>
		</div>
    </div>

    <div class="container post-fila mt-5 mr-0">
        <div class="row mt-5 align-items-center">
            <div class="col">
                <ul class="list-group text-contact mt-5">
                    <li class="list-group-horizontal py-2 fa fa-user"> <b>Nombre:</b> Juan Lopéz</li>
                    <li class="list-group-horizontal py-2 fa fa-address-book"> <b>Dirección:</b> <a href="https://www.google.com/search?channel=trow2&client=firefox-b-d&q=Avenida+de+Galicia%2C+n%C2%BA+134" data-toggle="tooltip"
                        data-placement="left" title="Nueva dirección!" id="enlace_direccion">Avenida de Galicia, nº 134</a></li>
                    <li class="list-group-horizontal py-2 fa fa-phone"> <b>Teléfono:</b> 986000000</li>
                    <li class="list-group-horizontal py-2 fa fa-envelope-open"> <b>Email:</b> contacto@panaderias.ml</li>
                    <li class="list-group-horizontal py-2 fa fa-clock-o"> <b>Horarios:</b>
                        <div class="horarios">De lunes a sábado: 8:30 a 20:00<br>Domingos y festivos: 10:00 a 14:00<div>
                    </li>
                </ul>
            </div>
            <div class="col my2">
                <div class="column" id="leafletMap"></div>
            </div>
        </div>

    </div>

    <!-- Sección Formulario Contacto -->
    <div class="container mb-4">
        <h1>Formulario de Contacto</h1>
        <form>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" placeholder="Escribe tu nombre completo..." id="nombre" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" placeholder="Escribe tu email..." id="email">
            </div>
            <div class="mb-3">
                <label for="mensaje">Mensaje:</label>
                <textarea class="form-control" placeholder="Escribe tu mensaje..." id="mensaje"
                    style="height: 100px"></textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terminos">
                <label class="form-check-label" for="terminos"><a href="politica_privacidad.html" target="_blank" style="text-decoration: none;">Acepto los términos y condiciones</a></label>
            </div>
        </form>
        <button class="btn btn-primary" data-toggle="popover" title="Ups!" data-content="Este formulario aún no esta activo, pero nos puede escribir a nuestro email.">Enviar</button>
    </div>


    <!-- Sección Footer -->
    <?php
  require_once 'footer.php';
 ?>

    <!-- JavaScript Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- Leaflet Map Library -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="js/mapa.js"></script>
    <!-- Javascript Header -->
    <script src="js/responsive_header.js"></script>
    <script src="js/functions.js"></script>
</body>

</html>