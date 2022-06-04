<?php
require_once(__DIR__ . './autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();
$user = json_decode($_SESSION['usuario']);

//header('Content-type: application/json; charset=utf-8');

if (isset($_GET['codProduct'])) {

    $arrayProducto = "";

    $codigoProducto = $_GET['codProduct'];

    if (is_numeric($codigoProducto)) {

        $db = new conect($_SESSION['rol']);

        $arrayProducto = $db->getProductById($codigoProducto);
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
            <h2 style="margin-top: 8%;text-align: center">Actualización del producto</h2>
            <form id="formulario_actualiza_producto" style="margin-top: 4%" class="shadow" enctype="multipart/form-data">
                <fieldset class="border p-4">

                    <?php
                 
                    if ($arrayProducto[0]['tipo_producto'] == '1') {
                        echo '<h3>Producto de Pastelería</h3>';
                    } else {
                        echo '<h3>Producto de Panadería</h3>';
                    }
                    ?>

                    <div class="form-group">
                        <div style="margin-top: 2%; display: flex">
                            <div>
                                <label>Código tipo de producto</label>
                                <input type="text" id="codigoProducto" name="codigoTipoProducto" value="<?php echo $arrayProducto[0]['tipo_producto'] ?>" readonly="redonly"></div>
                                <div style="margin-left: 3%">
                            <label>Código producto</label>
                            <input type="text" id="codigoProducto" name="codigoProducto" value="<?php echo $arrayProducto[0]['id'] ?>" readonly="redonly"></div></div><br><br>
                        <label>Nombre del producto</label><br>
                        <input type="text" name="nombreProducto" id="nombreProducto"value="<?php echo $arrayProducto[0]['nombre'] ?>" style="width: 100%;" class="p-2"><br><br>
                        <label>Descripción</label><br>
                        <input type="text" name="descripcion" id="descripcion" value="<?php echo $arrayProducto[0]['descripcion']; ?>" style="width: 100%;" class="p-2"><br><br>
                        <label>Precio $</label><br>
                        <input type="text" name="precio" id="precio" value="<?php echo $arrayProducto[0]['precio']; ?>" style="width: 100%;" class="p-2"><br><br>
                        <label>Cantidad</label><br>
                        <input type="text" name="cantidad" id="cantidad" value="<?php echo $arrayProducto[0]['cantidad']; ?>" style="width: 100%;" class="p-2"><br><br>
                        <label>Categorias</label><br><br>
                        <?php
                        $categorias = $db->load_categories();

                        foreach ($categorias as $key => $valor) {

                            foreach ($arrayProducto as $producto) {

                                if ($producto['nombre_categoria'] == $valor['nombre_categoria']) {

                                    echo '<div class="form-check">'
                                    . '<input class="form-check-input" type="radio" id="' . $valor['id'] . '" value="' . $valor['id'] . '" name="categoria" checked><label class="form-check-label" for="checkCategorias">' . $valor['nombre_categoria'] . '</label></div><br>';
                                } else {
                                    echo '<div class="form-check">'
                                    . '<input class="form-check-input" type="radio" id="' . $valor['id'] . '" value="' . $valor['id'] . '" name="categoria"><label class="form-check-label" for="checkCategorias">' . $valor['nombre_categoria'] . '</label></div><br>';
                                }
                            }
                        }
                        ?>
                        <div>
                            <div style='display: flex;'>
                                <div class="col-5 my-3 p-3">

                                    <label class="form-label">Subir imagen del producto:</label>
                                    <input id="img" class="form-control form-control-sm " type="file" name="img"/><p style="color:red">* Este campo no es obligatorio</p>
                                    <label style="color: darkgrey">Formato de imagen permitido: svg, jpeg, png.</label>

                                </div>
                            </div>
                        </div><br><br>
                        <div style="display:flex; margin-top: 4%">
                            <button type="button" name="update" class="btn btn-primary" id="boton_actualizar" style="margin: 0 30% 0 30%;" onclick="updateProduct()">Actualizar</button>
                            <button class="btn btn-danger" onclick="event.preventDefault();reject()" id="btn_reject">Cancelar</button>
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
        <script src="js/updateProduct.js"></script>
        <script>


                                function reject() {

                                    window.location.href = "userAdminPage.php";

                                }


        </script>

    </body>
</html>




