<?php
require_once(__DIR__ . '/autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

$db = new conect($_SESSION['rol']);

$user_id = json_decode($_SESSION['usuario'])->id;

$userData = $db->getUserData($user_id);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0" />
        <title>Inicio</title>
        <!-- Estilos página-->
        <link rel="stylesheet" href="css/pagina_panaderia.css">
        <link rel="stylesheet" href="css/panaderia_v2.css">
        <!-- Sweetalert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous" />
        <!-- Iconos Font Awesome--->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  

    </head>
    <body style="background-color: whitesmoke">
        <div class="container-flex">
            <?php
            require_once 'header.php';
            if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['registeredUsers'])) {
                header('location:registeredUsers.php');
            }
            ?>
        </div>
        <?php
        require_once 'navAdminPanel.php';
        ?>
        <div id="formularios_pedidos" class="container-fluid">
            <div id="lista_pedidos">
                <div id="busqueda_pedido">
                    <form class="form-group my-3 my-lg-0">
                        <input class="form-group" type="search" placeholder="Fecha del pedido" aria-label="Search">
                        <button class="btn btn-outline-success" type="button">Buscar</button>
                    </form>
                </div><br><br>

            </div>
            <div class="row">
                <div class="col-md-5">

                    <form id="form_order">
                        <fieldset class="border p-2">
                            <div class="form-group">
                                <div class="flex-container" style="display: flex">
                                    <div style="margin-left: 35%"><object type="image/svg+xml" data="images/aprobado.svg" style="width: 25px; height: 30px"><img src="images/aprobado.svg"></img></object></div>
                                    <div style="align-content:center"><h4 style="color: darkgreen; margin-left: 10px">Pedidos confirmados</h4><br><br></div>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Código</th>
                                            <th scope="col">Código cliente</th>
                                            <th scope="col">Fecha pedido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>


                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>


                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td colspan="2">Larry the Bird</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <div id="form_delete_order" class="col-md-3">
                    <form>
                        <fieldset class="border p-2">        
                            <div class="form-group">
                                <div class="flex-container" style="display: flex">
                                    <div><object type="image/svg+xml" data="images/signo_pregunta.svg" style="width: 25px; height: 30px; margin-left: 100px"><img src="images/signo_pregunta.svg"></img></object></div>
                                    <div style="align-content: center"><h4 style="color:red; margin-left: 10px">Pedidos pendientes por confirmar</h4></div>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Código</th>
                                            <th scope="col">Código cliente</th>
                                            <th scope="col">Fecha pedido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>


                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>


                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td colspan="2">Larry the Bird</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <br><br>

        </div>

        <?php
        require_once 'footer.php';
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="js/responsive_header.js"></script>
        
    </body>
</html>

