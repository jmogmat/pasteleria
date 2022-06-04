<?php
require_once(__DIR__ . './autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();
$user = json_decode($_SESSION['usuario']);

//header('Content-type: application/json; charset=utf-8');

if (isset($_GET['codCategorie'])) {

    $categorie = "";

    $idCategorie = $_GET['codCategorie'];

    if (is_numeric($idCategorie)) {

        $db = new conect($_SESSION['rol']);

        $categorie = $db->getCategorieById($idCategorie);
    }
}
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
    <body style="background-color: whitesmoke">
        <div class="container-flex">

            <?php require_once 'header.php'; ?>

        </div>
        <div class="container">
            <h2 style="margin-top: 8%;text-align: center">Editar categoría</h2>
            <form id="formulario_actualiza_categoria" style="margin-top: 4%" class="shadow">
                <fieldset class="border p-5">
                    <div class="form-group">
                        <div style="margin-top: 2%;">
                            <label>Código de categoría</label>
                            <input type="text" name="idCategoria" value="<?php echo $idCategorie; ?>" readonly="redonly" style="margin-left: 1%"><br><br>
                            <label>Nombre de la categoría</label><br>
                            <input type="text" name="nombreCategoria" id="nombreCategoria"value="<?php echo $categorie; ?>" style="width: 100%; padding: 1%; margin-top: 1%"><br><br>
                            <br><br>
                            <div style="display:flex; margin-top: 4%">
                                <button type="button" name="update" class="btn btn-primary" id="boton_actualizar" style="margin: 0 30% 0 30%; padding: 1%" onclick="updateCategorie()">Actualizar</button>
                                <button class="btn btn-danger" onclick="event.preventDefault();reject()" id="btn_reject" style="padding: 1%">Cancelar</button>
                            </div>
                        </div>
                </fieldset>
            </form>
        </div>

        <?php
        require_once 'footer.php';
        ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="js/updateCategorie.js"></script>
        <script>


                                    function reject() {

                                        window.location.href = "userAdminPage.php";

                                    }


        </script>

    </body>
</html>





