<?php
require_once __DIR__ . '/autoload.php';

use functions\functions as func;
use \conectDB\conectDB as conect;

$sesion = new func();

$sesion->checkSession();
?>
<!DOCTYPE html>
<html lang="es">

    <?php
    require_once 'head.php';
    ?>

    <body>

        <div class="container-flex">
            <div class="row justify-content-around">

                <?php
                require_once 'header.php';
                ?>

                <?php
                $image = '';

                $db = new conect($_SESSION['rol']);

                $productsBakery = $db->getAllProductsBakery(); //Todos los productos de panaderia

                $imgProductsBakery = $db->getImgfromProductsBakery(); //Ruta de todas las imagenes y el id del producto

                foreach ($productsBakery as $v) {

                    foreach ($imgProductsBakery as $i) {

                        if ($i['id'] == $v['id']) {

                            $nameImg = pathinfo($i['ruta'], PATHINFO_BASENAME);
                            $image = 'images/imagenes_de_pan/'. $nameImg;
                            ?>
                            <div class="col-auto shadow rounded p-1" style="margin-top: 4%;">
                                <form>
                                    <div class="" style="text-align: center">
                                        <div style="width: 30rem;">
                                            
                                                <div class="">
                                                    <span class="image mr-half inline-block" style="text-align: center">
                                                        <div><object type="image/svg+xml" data="<?php $image; ?>" >
                                                                <img id="imagen" src="<?php echo $image; ?>" style="width: 400px; height: 300px"></img>
                                                            </object>
                                                        </div>
                                                    </span>
                                                </div>
                                        
                                            <div class="card-body">
                                                <fieldset class="border p-2 rounded"">
                                                    <h5><?php echo $v['nombre']; ?></h5>
                                                    <p class=""><?php echo $v['descripcion']; ?></p>
                                                    <p class="" style="font-size: 20px; font-weight: bold;"><?php echo $v['precio']; ?> €</p>
                                                    <button class="btn btn-primary" style="cursor:pointer; font-size: 15px;"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
            <?php
        }
    }
}
?>


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


    </body>

</html>