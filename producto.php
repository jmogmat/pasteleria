<?php
require_once __DIR__ . '/autoload.php'; 
        
use functions\Functions as func; 	
        
$sesion = new func(); 
        
$sesion->checkSession(); 


?>
<!DOCTYPE html>
<html lang="es">

<!-- Iconos Font Awesome--->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<body>

    <?php
    require_once 'header.php';
     ?>
    
      <div class="hambMenu" id="hambMenu">
        <a class="itemMenu" href="index.php">Inicio</a>
        <a class="itemMenu" href="panaderia.php">Panaderia</a>
        <a class="itemMenu" href="pasteleria.php">Pasteleria</a>
        <a class="itemMenu" href="contacto.php">Contacto</a>
      </div>
      
    <div class="producto">
        <img src="images/cuadro-panaderias-ml.png" class="img_producto"></a>
        <div class="div_producto_info">
            <p class="p_producto_name" id="name"><b>Cuadro Panaderías M.L.</b></p>
            <p class="p_producto"><b>Descripción:</b></p>
            <p class="p_producto" id="descripcion_text">Cuadro con el logo de Panaderías M.L. hecho solo por encargo. La disponibilidad de esta obra de arte es muy limitada.</p>
        </div>
        <div class="div_precio">
            <p class="precio_producto">Precio: 10€</p>
            <button class="btn_comprar">Comprar</button>
        </div>
    </div>

    <h2 class="h2_producto">Productos relacionados:</h2>

    <div class="productos_relacionados">
        <a href="producto.php?id=2"><img src="images/imagenes_de_pan/pan_de_cea.jpg" class="img_rel_producto"/></a>
        <a href="producto.php?id=3"><img src="images/imagenes_de_pan/pan_integral.jpg" class="img_rel_producto"/></a>
        <a href="producto.php?id=4"><img src="images/imagenes_de_pasteles/croissants.jpg" class="img_rel_producto"/></a>
        <a href="producto.php?id=5"><img src="images/imagenes_de_pasteles/brownie-de-chocolate.jpg" class="img_rel_producto"/></a>
        <a href="producto.php?id=7"><img src="images/imagenes_de_pasteles/tarta_abuela.jpg" class="img_rel_producto"/></a>
        <a href="producto.php?id=6"><img src="images/imagenes_de_pasteles/pasteles_de_nata.jpg" class="img_rel_producto"/></a>
    </div>


  <?php
  require_once 'footer.php';
 ?>


	<script src="js/responsive_header.js"></script>
    <script src="js/producto.js"></script>
</body>

</html>