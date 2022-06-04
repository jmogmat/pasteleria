<?php
require_once __DIR__ . '/autoload.php'; 
        
use functions\functions as func; 	
        
$sesion = new func(); 
        
$sesion->checkSession(); 


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panadería</title>
  <!-- Estilos página-->
  <link rel="stylesheet" href="css/pagina_panaderia.css">
  <link rel="stylesheet" href="css/panaderia_v2.css">
  <!-- CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous" />
  <!-- Iconos Font Awesome--->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>

  <div class="container-flex">
    <?php
    require_once 'header.php';
     ?>

    <div class="hambMenu" id="hambMenu">
      <a class="itemMenu" href="index.php">Inicio</a>
      <a class="itemMenu pag_actual" href="panaderia.php">Panaderia</a>
      <a class="itemMenu" href="pasteleria.php">Pasteleria</a>
      <a class="itemMenu" href="blog.php">Blog</a>
      <a class="itemMenu" id="item-final-menu" href="contacto.php">Contacto</a>
    </div>
  </div>

  <div class="banner_bread">
   
  </div>

  <div class="productsContainer">
    <div class="productContainer">
      <a href="producto.php?id=0"><img src="images/imagenes_de_pan/pan_redondo.jpg" class="productPicture"
          alt="ofertas_de_pan"></a>
      <div class="productText"><b>Bollo de pan artesanal</b></div>
    </div>
    <div class="productContainer">
      <a href="producto.php?id=1"><img src="images/imagenes_de_pan/barras_de_pan.jpg" class="productPicture"
          alt="ofertas_de_pan"></a>
      <div class="productText"><b>Barras de pan de ayer</b></div>
    </div>
    <div class="productContainer">
      <a href="producto.php?id=2"><img src="images/imagenes_de_pan/pan_de_cea.jpg" class="productPicture"
          alt="ofertas_de_pan"></a>
      <div class="productText"><b>Pan artesano de Cea</b></div>
    </div>
    <div class="productContainer">
      <a href="producto.php?id=3"><img src="images/imagenes_de_pan/pan_integral.jpg" class="productPicture"
          alt="ofertas_de_pan"></a>
      <div class="productText"><b>Pan integral</b></div>
    </div>
    <div class="productContainer">
      <a href="producto.php?id=10"><img src="images/imagenes_de_pan/pan_sin_gluten.jpg" class="productPicture"
          alt="ofertas_de_pan"></a>
      <div class="productText"><b>Pan sin glutén</b></div>
    </div>
    <div class="productContainer">
      <a href="producto.php?id=11"><img src="images/imagenes_de_pan/barra_rustica.png" class="productPicture"
          alt="ofertas_de_pan"></a>
      <div class="productText"><b>Barra de Pan Rústico</b></div>
    </div>
  </div>
  </div>

  <?php
  require_once 'footer.php';
 ?>

  <!-- JavaScript Bundle with Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>

  <script src="js/responsive_header.js"></script>
  <script src="js/functions.js"></script>

</body>

</html>