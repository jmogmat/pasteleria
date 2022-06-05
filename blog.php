<?php
require_once __DIR__ . '/autoload.php';

use functions\functions as func;

$sesion = new func();

$sesion->checkSession();
?>
<!DOCTYPE html>
<html lang="es">

<?php
require_once 'head.php';
?>

    <body>

        <div class="container-flex mb-5">
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

        <canvas id="canvas_animacion" class="mt-5" width="auto" height="2"></canvas>

        <!-- Sección Posts -->
        <div class="container post-fila">
            <div class="row">
                <div class="col-sm d-flex align-items-stretch">
                    <a href="post.php" class="custom-card">
                        <div class="card mb-2 mt-0">
                            <img src="https://images.unsplash.com/photo-1576422558070-ae29d728947e?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1500&q=80"
                                 class="card-img-top" alt="..." />
                            <div class="card-body">
                                <div class="card-text">
                                    <div class="mb-3">
                                        <span class="badge bg-danger post-categorias">Ofertas</span>
                                        <span class="badge bg-primary post-categorias">Navidad</span>
                                    </div>
                                    <p>
                                        Las ofertas navideñas más dulces de todas las navidades,
                                        ¿te las piensas perder? Haz click y descubrelas.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm d-flex align-items-stretch">
                    <div class="card mb-0 mt-0">
                        <img src="https://images.unsplash.com/photo-1532102522784-9e4d4d9a533c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80"
                             class="card-img-top" alt="..." />
                        <div class="card-body">
                            <div class="card-text">
                                <div class="mb-3">
                                    <span class="badge bg-danger post-categorias">Noticias</span>
                                    <span class="badge bg-primary post-categorias">Productos</span>
                                </div>
                                <p>
                                    Ahora puedes contactar más rápido con nosotros
                                    usando el formulario de la página de contacto.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container post-fila">
            <div class="row">

                <div class="col-sm d-flex align-items-stretch">
                    <div class="card my-2">
                        <img src="https://images.unsplash.com/photo-1607083206325-caf1edba7a0f?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=756&q=80"
                             class="card-img-top" alt="Oferta Black Friday" />
                        <div class="card-body">
                            <div class="card-text">
                                <div class="mb-3">
                                    <span class="badge bg-danger post-categorias">Ofertas</span>
                                    <span class="badge bg-dark post-categorias">Black Friday</span>
                                </div>
                                <p>
                                    No te pierdas los impresionantes descuentos que tenemos
                                    para vosotros en este Black Friday.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm d-flex align-items-stretch">
                    <div class="card my-2">
                        <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80"
                             class="card-img-top" alt="..." />
                        <div class="card-body">
                            <div class="card-text">
                                <div class="mb-3">
                                    <span class="badge bg-danger post-categorias">Noticias</span>
                                    <span class="badge bg-primary post-categorias">Productos</span>
                                </div>
                                <p>
                                    Nuevos ingredientes!! Incluimos pan de centeno
                                    tradicional a nuestra oferta gracias a la nueva harina.
                                </p>
                            </div>
                        </div>
                    </div>
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
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <!-- Javascript Header -->
        <script src="js/responsive_header.js"></script>
        <script src="js/functions.js"></script>
    </body>

</html>