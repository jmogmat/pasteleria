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
            <h2 class="titulo_politicas">Política de Privacidad</h2>
            <h1>Introducción</h1>

            <p class="p_politica">El Reglamento general de protección de datos (RGPD) es el marco jurídico que regula
                el tratamiento de datos personales en Europa a partir del 25 de mayo del 2018. Al contrario que
                la directiva 95/46/CE que deroga, el RGPD es directamente aplicable en la Unión y no necesita ser
                transpuesto a una legislación nacional. Por esa razón, va a favorecer la
                armonización de los regímenes jurídicos en materia de protección de datos personales en
                Europa y, lo que es aún mejor, goza de un principio de extraterritorialidad que, en
                determinadas circunstancias, le permite extender su ámbito de aplicación más allá de las
                fronteras europeas.</p>

            <h1>Definiciones</h1>

            <p class="p_politica">Entender las implicaciones reales y concretas de un reglamento europeo no siempre es
                fácil,
                especialmente cuando este consta de 99 artículos, 173 considerandos y numerosas líneas
                directivas destinadas a aclarar su interpretación. Y, sin embargo, es fundamental para evitar
                las consecuencias que podrían derivarse de una interpretación demasiado genérica o
                imprecisa de las obligaciones reglamentarias que incumban a su organización. Así pues, es
                importante entender correctamente los términos que se definen a continuación:
                Datos personales: Toda información sobre una persona física identificada o identificable. Se
                considerará persona física identificable toda persona cuya identidad pueda determinarse,
                directa o indirectamente.
            <p class="p_politica">
            <ul class="lista">
                <li><b>Tratamiento:</b> Cualquier operación o conjunto de operaciones realizadas sobre datos
                    personales o conjuntos de datos personales, ya sea por procedimientos automatizados o no
                    (recogida, registro, transmisión, almacenamiento, conservación, extracción, consulta,
                    utilización, interconexión...).</li>
                <li><b>Tratamiento:</b> Cualquier operación o conjunto de operaciones realizadas sobre datos
                    personales o conjuntos de datos personales, ya sea por procedimientos automatizados o no
                    (recogida, registro, transmisión, almacenamiento, conservación, extracción, consulta,
                    utilización, interconexión...).</li>
                <li><b>Responsable del tratamiento:</b> Persona física o jurídica, autoridad pública, servicio u otro
                    organismo que, solo o junto con otros, determine los fines y los medios del tratamiento.
                    Encargado del tratamiento: Persona física o jurídica, autoridad pública, servicio u otro
                    organismo que trate datos personales por cuenta del responsable del tratamiento.</li>
            </ul>
            <h2>Protección de datos personales</h2>

            <p class="p_politica">Para nosotros la protección de los datos personales de los usuarios es importante, en la
                actualidad en esta web manejamos algunos dato de carácter personal que vosotros como
                usuarios del sitio web nos dais.</p>

            <h3>¿Cuales son los datos personales que recopilamos?</h3>

            <p class="p_politica">Panaderias.ml recopila y procesa los datos personales que usted mismo nos envía al
                registrarse o solicitar nuestros servicios de otras formas (teléfono, email, …).</p>
            <h3>¿A quién damos sus datos personales?</h3>
            <p class="p_politica">La compañía puede dar datos personales como la dirección, teléfono o nombre completo
                para realizar los repartos a la compañía de reparto encargada de dicho propósito.
                Los empleados de la compañía pueden ver parte de los datos personales de los clientes con
                fines de preparar los pedidos pero siempre con la obligación de cumplir con el requisito de
                confidencialidad.</p>
            <h3>¿Almacenamos o guardamos datos de pago?</h3>
            <p class="p_politica">Nosotros principalmente por motivos de seguridad no guardamos ni procesamos datos
                financieros de los usuarios, este proceso lo realizará la pasarela de pago Stripe.com</p>
            <h3>¿Qué pasa con los enlaces externos o a las redes sociales que puedes encontrar en nuestro
                sitio web?</h3>

            <p class="p_politica">Este sitio web puede contener enlaces a sitios web de terceros, términos legales, así como
                redes sociales (posibilidad de compartir contenido en las redes sociales como Twitter o
                similares). Cabe señalar que los sitios de terceros cuyos enlaces se publican en el sitio web
                están sujetos a las políticas de privacidad de estos sitios web y nuestra compañía no es
                responsable por el contenido de la información proporcionada por estos sitios web, sus
                actividades y sus políticas de privacidad.</p>

            <h2>Encargados del tratamiento</h2>

            <ul class="lista">
                <li><b>Google Analytics:</b> es un servicio de análisis de web prestado por Google Inc., una compañía
                    cuya oficina principal está en 1600 Amphitheatre Parkway, Mountain View (California), CA
                    94043, Estados Unidos ("Google"). Google Analytics utiliza "cookies", que son archivos de
                    texto ubicados en tu ordenador, para ayudar a "panaderias.ml" a analizar el uso que
                    hacen los usuarios del sitio web. La información que genera la cookie de Google Analytics
                    acerca de su uso de "panaderias.ml" (incluyendo tu dirección IP) será directamente
                    transmitida y archivada por Google en sus servidores ubicados en Estados Unidos.</li><br>
                <li><b>Hosting:</b> Nosotros usamos como proveedor de hosting VPS la empresa Time4VPS, con
                    domicilio social en J. Kubiliaus st. 6, 08234 Vilnius, Lithuania..</li><br>
                <li><b>Pasarela de pago:</b> Usamos el procesador de pagos Stripe que tiene su domicilio social en el
                    510 Townsend Street, San Francisco, CA 94103, Estados Unidos. Esta pasarela de pago
                    procesa datos de los usuarios cuando estás realizando el pago de tu compra recolectando
                    información como el nombre del titular de la tarjeta, el número de la tarjeta de crédito, la
                    fecha de caducidad de la tarjeta y el código CVC para efectuar el pago.
                    Todos estos datos van directamente desde el usuario hasta la API de Stripe, esto quiere decir
                    que nuestro sitio web no procesa o guarda información relacionada con las tarjetas o datos
                    bancarios de los clientes.</li>
            </ul>

            <h2>Medidas de seguridad</h2>

            <p class="p_politica">Como medidas de seguridad para proteger los datos de los usuarios tenemos activado un
                corta fuegos en el servidor, realizamos actualizaciones semanales y mensuales, copias de
                seguridad diarias cifradas y nos mantenemos al tanto de las vulnerabilidades que puedan
                salir de los frameworks o programas que estamos usando.</p>
            <p class="p_politica">En el caso de sufrir una brecha avisaremos a los usuarios afectados lo más pronto posible
                dentro del plazo de 72h desde que detectamos la brecha y informaremos a las autoridades
                competentes incluida la agencia de protección de datos.</p>
            <h2>Ejerza sus derechos</h2>
            <p class="p_politica">Puede ejercitar tus derechos de acceso, rectificación, cancelación y oposición a través
                nuestro correo electrónico que puede encontrar en la página de contacto junto con una
                prueba válida de su derecho, como foto del D.N.I. o equivalente, indicando en el asunto
                “Protección de Datos”. Nosotros atenderemos su petición dentro del plazo máximo de 30 días
                que establece la ley de protección de datos (GDPR) y en el menor tiempo posible.</p>
            <p class="p_politica"><b>Fecha de última revisión:</b> 13/10/2020</p>

        </div>

<?php
require_once 'footer.php';
?>

        <script src="js/responsive_header.js"></script>

    </body>

</html>