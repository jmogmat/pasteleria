<?php
require_once __DIR__ . '/autoload.php';

use functions\Functions as func;

$sesion = new func();

$sesion->checkSession();
?>
<!DOCTYPE html>
<html lang="es">

<?php
require_once 'head.php';
?>

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
            <h2 class="titulo_politicas">Política de Cookies</h2>
            <p class="p_politica">Aunque en nuestra panadería vendemos unas cookies de chocolate que están para chuparse
                los dedos, en esta página os venimos a hablar de un tipo muy distinto “cookies” que no son
                comestibles pero si influyen en el uso de nuestra web.</p>

            <h2>¿Qué son las cookies?</h2>


            <p class="p_politica">Las Cookies son un fichero que se descarga en nuestro ordenador al acceder a
                determinados sitios web. Las cookies permiten a una página web, entre otras cosas,
                almacenar y recuperar información sobre los hábitos de navegación de un usuario o de su
                equipo y, dependiendo de la información que contengan y de la forma en que utilice su
                equipo, pueden utilizarse para reconocer al usuario.</p>

            <h2>¿Qué tipos de cookies utiliza esta página web?</h2>

            <ul class="lista">
                <li><b>Cookies técnicas:</b> Son aquéllas que permiten al usuario la navegación a través de una
                    página web, plataforma o aplicación y la utilización de las diferentes opciones o servicios que
                    en ella existan como, por ejemplo, controlar el tráfico y la comunicación de datos, identificar
                    la sesión, acceder a partes de acceso restringido, recordar los elementos que integran un
                    pedido, realizar el proceso de compra de un pedido, realizar la solicitud de inscripción o
                    participación en un evento, utilizar elementos de seguridad durante la navegación, almacenar
                    contenidos para la difusión de vídeos o sonido o compartir contenidos a través de redes
                    sociales.</li><br>
                <li><b>Cookies de personalización:</b> Son aquéllas que permiten al usuario acceder al servicio con
                    algunas características de carácter general predefinidas en función de una serie de criterios
                    en el terminal del usuario como por ejemplo serian el idioma, el tipo de navegador a través
                    del cual accede al servicio, la configuración regional desde donde accede al servicio, etc.
                    Cookies de análisis: Son aquéllas que bien tratadas por nosotros o por terceros, nos
                    permiten cuantificar el número de usuarios y así realizar la medición y análisis estadístico de
                    la utilización que hacen los usuarios del servicio ofertado. Para ello se analiza su navegación
                    en nuestra página web con el fin de mejorar la oferta de productos o servicios que le
                    ofrecemos.</li><br>
                <li><b>Cookies publicitarias:</b> Son aquéllas que, bien tratadas por nosotros o por terceros, nos
                    permiten gestionar de la forma más eficaz posible la oferta de los espacios publicitarios que
                    hay en la página web, adecuando el contenido del anuncio al contenido del servicio solicitado
                    o al uso que realice de nuestra página web. Para ello podemos analizar sus hábitos de
                    navegación en Internet y podemos mostrarle publicidad relacionada con su perfil de
                    navegación.</li><br>
                <li><b>Cookies de publicidad comportamental:</b> Son aquéllas que permiten la gestión, de la forma
                    más eficaz posible, de los espacios publicitarios que, en su caso, el editor haya incluido en
                    una página web, aplicación o plataforma desde la que presta el servicio solicitado. Estas
                    cookies almacenan información del comportamiento de los usuarios obtenida a través de la
                    observación continuada de sus hábitos de navegación, lo que permite desarrollar un perfil
                    específico para mostrar publicidad en función del mismo.</li><br>
                <li><b>Cookies de terceros:</b> Nuestra web puede utilizar servicios de terceros como Google
                    Analytics que recopilaran información con fines estadísticos, de uso del sitio web por parte de
                    los usuarios y que puede servir para prestar otros servicios relacionados con la actividad de
                    nuestro sitio web u otros servicios de internet.</li>
            </ul>

            <h2>¿Cómo puedo desactivar el uso de cookies o puedo borrarlas?</h2>

            <p class="p_politica">Este proceso varia un poco dependiendo del navegador que estés usando, pero como
                usuario del mismo puedes configurar el navegador para no aceptar las cookies, bloquearlas o
                borrarlas. A continuación os indicamos los pasos que debéis seguir en vuestro navegador
                web para borrar, deshabilitar o bloquear las cookies:</p>

            <div class="lista">
                <ul>
                    <li class="li_politica"><b>Internet Explorer:</b> Herramientas → Opciones de Internet → Privacidad → Configuración.</li>
                    <li class="li_politica"><b>Edge Chromium:</b> Configuración → Permisos del sitio.</li>
                    <li class="li_politica"><b>Firefox:</b> Herramientas → Opciones → Privacidad → Historial → Configuración Personalizada.</li>
                    <li class="li_politica"><b>Chrome:</b> Configuración → Mostrar opciones avanzadas → Privacidad → Configuración de
                        contenido.</li>
                    <li class="li_politica"><b>Safari:</b> Preferencias → Seguridad</li>
                </ul>
            </div>
            <p class="p_politica"><b>Fecha de última revisión:</b> 13/10/2020</p>
        </div>

<?php
require_once 'footer.php';
?>

    </body>

</html>