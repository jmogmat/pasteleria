<?php
require_once(__DIR__ . './autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

error_reporting(E_ALL);
ini_set("display_errors", 1);

$tool = new func();

$tool->checkSession();

$db = new conect($_SESSION['rol']);
?>

<!DOCTYPE html>
<html lang="es">

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



    <body>
        <div class="container-flex">

            <?php
            require_once 'header.php';
            ?>

            <div class="hambMenu" id="hambMenu">
                <a class="itemMenu" href="index.php">Inicio</a>
                <a class="itemMenu" href="panaderia.php">Panaderia</a>
                <a class="itemMenu" href="pasteleria.php">Pasteleria</a>
                <a class="itemMenu" href="blog.html">Blog</a>
                <a class="itemMenu" id="item-final-menu" href="contacto.php">Contacto</a>
            </div>
        </div>

        <div class="col-2" style="margin: auto; display: inline" id="login">
            <fieldset class="border p-2 rounded shadow">
                <main class="form-signin w-100 m-auto">
                    <form id="form_login">
                        <br>

                        <h4 class="fw-normal" style="text-align:center">¿Ya eres cliente?</h4><br>

                        <div class="form-floating">
                            <input type="email" class="form-control" name="emailLogin" required placeholder="name@example.com">
                            <label for="floatingInput">Correo eléctronico</label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="passLogin" required placeholder="Password">
                            <label for="floatingPassword">Contraseña</label>
                        </div>
                        <br>
                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" value="remember-me"> Recuérdame
                            </label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit" id="btn_login" onclick="event.preventDefault();loginUser()">Iniciar sesión</button>
                    </form>
                    <fieldset class="border p-2 rounded">
                    <h4 class="fw-normal" style="text-align:center">¿Todavía no eres cliente?</h4>
                    <h6 style="text-align:center">¡No esperes más!</h6>
                    <button type="button" class="w-100 btn btn-lg btn-light" id="btn_registrarme" onclick="change1()">Crea una cuenta</button>
                    </fieldset>
                </main>
            </fieldset>
        </div>

        <div class="col-2" style="margin: auto; display: none" id="register">
            <fieldset class="border p-2 rounded shadow">
                <main class="form-signin w-100 m-auto">
                    <form id="registerUserForm">
                        <br>

                        <h4 class="fw-normal" style="text-align:center">Crea tu cuenta</h4><br>

                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" id="name" required placeholder="name@example.com">
                            <label for="floatingInput">Nombre</label>
                        </div><br>
                        <div class="form-floating">
                            <input type="text" class="form-control" name="surname" id="surname" required placeholder="name@example.com">
                            <label for="floatingInput">Apellido</label>
                        </div><br>

                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="email" required placeholder="name@example.com">
                            <label for="floatingInput">Correo eléctronico</label>
                        </div><br>
                        <div class="form-floating">
                            <input type="text" class="form-control" name="phone" id="phone" required placeholder="name@example.com">
                            <label for="floatingInput">Telefono</label>
                        </div><br>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="pass1" id="pass1" required placeholder="Password">
                            <label for="floatingPassword">Contraseña</label>
                        </div><br>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="pass2" id="pass2" required placeholder="Password">
                            <label for="floatingPassword">Rep-contraseña</label>
                        </div><br>
                        <br>                  
                        <button type="button" class="w-100 btn btn-lg btn-primary" name="btn_register" id="register" onclick="registerUser()">Registrarme</button>
                    </form>
                    <br>
                    <fieldset class="border p-2 rounded" >
                    <h4 class="fw-normal" style="text-align:center">¿Ya tienes cuenta?</h4>
                    <h6 style="text-align:center">¡Logueate!</h6>
                    <button type="button" class="w-100 btn btn-lg btn-light" id="btn_loguearme" onclick="change2()">Iniciar sesión</button>
                     </fieldset>
                </main>
            </fieldset>
        </div>



        <?php
        require_once 'footer.php';
        ?>

        <!-- JavaScript Bundle with Popper.js -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="js/responsive_header.js"></script>
        <script src="js/register.js"></script>
        <script src="js/loginUser.js"></script>
        <script src="js/registerAndLogin.js"></script>

    </body>

</html>