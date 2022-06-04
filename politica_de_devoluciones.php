<?php
require_once __DIR__ . '/autoload.php'; 
        
use functions\Functions as func; 	
        
$sesion = new func(); 
        
$sesion->checkSession(); 


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Devoluciones y Cancelaciones</title>
    <!-- Estilos página-->
    <link rel="stylesheet" href="css/pagina_panaderia.css">
    <!-- Iconos Font Awesome--->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

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



    <div class="texto_politica">
        <h2 class="titulo_politicas">Política de Devoluciones y Cancelaciones</h2>
        <p class="p_politica">Todos nuestros productos son frescos, debido a que todos los pedidos se elaboran el mismo
            día que tenemos que realizar la entrega de los mismos. Gracias a eso podemos garantizar la
            calidad, el buen hacer y la frescura de todos nuestros productos.</p>

        <h2>Devoluciones</h2>

        <p class="p_politica">Si alguno de nuestros productos llegará en mal estado o no estuviera fresco a juicio del
            cliente, este podrá ser devuelto siempre que al menos el 90% del mismo nos fuese devuelto
            sin haber sido consumido.</p>

        <p class="p_politica">Es importante que nos mande el producto de vuelta en el mismo día para que podamos
            verificar la frescura del mismo ya que en nuestra panadería no empleamos conservantes en
            nuestros productos.</p>

        <p class="p_politica">En el caso de que el pedido no sea devuelto en nuestra tienda física y se envié usando un
            transportista los gastos de envió correrán a cargo del cliente.</p>

        <p class="p_politica">El rembolso del dinero se puede hacer en forma de vale para comprar otro producto en
            nuestro sitio web más un pequeño cupón descuento que podéis usar en el momento de
            tramitar el pedido o una devolución del dinero a vuestra cuenta bancaria.</p>

        <h2>Cancelaciones</h2>

        <p class="p_politica">El plazo máximo que ofrecemos para cancelar un pedido es de 24 horas antes de la fecha de
            entrega debido a que una vez que el pedido.</p>

        <p class="p_politica"><b>Fecha de última revisión:</b> 13/10/2020</p>
    </div>

    <?php
  require_once 'footer.php';
 ?>


    <script src="js/responsive_header.js"></script>

</body>

</html>