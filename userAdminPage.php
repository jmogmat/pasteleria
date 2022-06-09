<?php
require_once(__DIR__ . '/autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

$db = new conect($_SESSION['rol']);

$user_id = json_decode($_SESSION['usuario'])->id;

$userData = $db->getUserData($user_id);

$productsByPage = 3;
$pages = $db->countProducts();
$totalPages = $pages / 3;
$totalPages = ceil($totalPages);

if (!$_GET) {
    header('location:userAdminPage.php?page=1');
}

if (array_key_exists('page', $_GET)) {
    $pagina = $_GET['page'];
}


if ($_GET['page'] > $totalPages || $_GET['page'] <= 0) {
    header('location:userAdminPage.php?page=1');
}

$start = ($_GET['page'] - 1) * $productsByPage;
?>
<!DOCTYPE html>
<html lang="en">
    <?php
    require_once 'head.php';
    ?>


    <body style="background-color: rgb(246,246,246)">

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


        <h2 style="text-align: center" style="color: darkslategray">Panel de administración</h2>
        <div id="formularios_productos" class="container-flex" style="margin-left: 12%; margin-top: 3%">
            <div class="row">
                <div class="col-md-5">
                    <form id="form_upload_product" enctype="multipart/form-data">
                        <fieldset class="border p-2">
                            <div class="form-group">
                                <div class="flex-container" style="display: flex">
                                    <div style="margin-left: 35%"><object type="image/svg+xml" data="images/signo_mas.svg" style="width: 25px; height: 30px"><img src="images/signo_mas.svg"></img></object></div>
                                    <div style="align-content:center"><h4 style="color: royalblue; margin-left: 10px">Agregar un producto</h4><br><br></div>
                                </div>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="codigoTipoProducto" id="pasteleria" checked="checked" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Pastelería
                                        </label>
                                    </div><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="codigoTipoProducto" id="panaderia" value="2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Panadería
                                        </label>
                                    </div><br><br>
                                </div>
                                <label>Nombre:</label><br>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" name="nombre_producto" id="nombre_producto" placeholder="Nombre del producto" required><br><br>
                                <label>Descripción:</label><br>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" maxlength="50" name="descripcion" id="descripcion" placeholder="Descripción del producto" required><br><br>
                                <label>Precio:</label><br>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" name="precio" id="precio" placeholder="Precio del producto" required><br><br>
                                <label>Cantidad:</label><br>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" name="cantidad" id="cantidad" placeholder="Cantidad del producto Maximo 30" required><br><br>
                                <label>Categorias:</label><br><br>
                                <?php
                                $categorias = $db->load_categories();

                                foreach ($categorias as $key => $categoria) {

                                    if ($categoria['nombre_categoria'] === 'sin gluten') {


                                        echo '<div class="form-check">'
                                        . '<input class="form-check-input" type="radio" id="'
                                        . $categoria['id'] . '" value="' . $categoria['id'] .
                                        '" name="categoria" checked><label class="form-check-label" for="categorias">'
                                        . $categoria['nombre_categoria'] . '</label>'
                                        . '</div><br>';
                                    }

                                    if ($categoria['nombre_categoria'] === 'contiene gluten') {
                                        echo '<div class="form-check">'
                                        . '<input class="form-check-input" type="radio" id="'
                                        . $categoria['id'] . '" value="' . $categoria['id'] .
                                        '" name="categoria" checked><label class="form-check-label" for="categorias">'
                                        . $categoria['nombre_categoria'] . '</label>'
                                        . '</div><br>';
                                    }

                                    if ($categoria['nombre_categoria'] != 'contiene gluten' && $categoria['nombre_categoria'] != 'sin gluten') {

                                        echo '<input type="checkbox" class="form-check-input" id="' . $categoria['id'] . '" name="' . $categoria['id'] . '" value="' . $categoria['nombre_categoria'] . '">' . " " . $categoria['nombre_categoria'] . '<br><br>';
                                    }
                                }
                                ?>
                                <div>
                                    <div style='display: flex;'>
                                        <div class="col-5 my-3 p-3">
                                            <label class="form-label">Subir imagen del producto:</label>
                                            <input id="img" class="form-control form-control-sm " type="file" name="img"/><br>
                                            <label style="color: darkgrey">Formato de imagen permitido: svg, jpeg, png.</label><br><br>
                                            <p style="color: red">* Todos los campos son obligatorios</p>
                                        </div>
                                    </div>
                                </div><br><br>
                                <div style="text-align: center"> 
                                    <button type="button" class="btn btn-primary mb-2" name="boton_agregar_producto" id="boton_agregar_producto" onclick="uploadProduct()">Agregar producto</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-md-5">
                    <div id="form_delete_product">
                        <form>
                            <fieldset class="border p-2 ">        
                                <div class="form-group">
                                    <div class="flex-container" style="display: flex">
                                        <div style="margin-left: 35%"><object type="image/svg+xml" data="images/papelera.svg" style="width: 25px; height: 30px;"><img src="images/papelera.svg"></img></object></div>
                                        <div style="align-content: center"><h4 style="color:red; margin-left: 10px">Eliminar un producto</h4></div>
                                    </div>
                                    <label>ID del producto:</label><br>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp" name="id_producto" id="id_producto" placeholder="Codigo ID del producto"><br><br>
                                    <div style="text-align: center">
                                        <button type="button" class="btn btn-danger mb-2" name="boton_eliminar_producto" id="boton_eliminar_producto" onclick="deleteProduct()">Eliminar producto</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div id="form_add_categorie" style="margin-top: 8%"> 
                        <form id="form_categoria">
                            <fieldset class="border p-2">
                                <div class="form-group">          
                                    <div class="form-group">
                                        <div class="flex-container" style="margin: auto ">
                                            <div style="display: flex;">
                                                <div style="margin-left: 35%"><object type="image/svg+xml" data="images/signo_mas.svg" style="width: 25px; height: 30px"><img src="images/signo_mas.svg"></img></object></div>
                                                <h4 style="color: royalblue; margin-left: 2%">Agregar una categoría</h4>
                                                <br><br>
                                            </div>                                 
                                        </div>

                                        <label>Nombre:</label><br>
                                        <input type="text" class="form-control"  aria-describedby="emailHelp" name="nombre_categoria" id="nombre_categoria" placeholder="Nombre de la categoría"><br><br>
                                        <div style="text-align: center">
                                            <button type="button" class="btn btn-primary mb-2" name="boton_agregar_categoria" id="boton_agregar_categoria" onclick="addCategorie()">Agregar categoría</button>
                                        </div>
                                    </div>
                                </div> 
                            </fieldset>   
                        </form>   
                    </div>
                     <div id="form_delete_categorie" style="margin-top: 8%"> 
                        <form id="deleteCategorie">
                            <fieldset class="border p-2">
                                <div class="form-group">          
                                    <div class="form-group">
                                        <div class="flex-container" style="margin: auto ">
                                            <div style="display: flex;">
                                                <div style="margin-left: 35%"><object type="image/svg+xml" data="images/papelera.svg" style="width: 25px; height: 30px"><img src="images/papelera.svg"></img></object></div>
                                                <h4 style="color: royalblue; margin-left: 2%">Borrar una categoría</h4>
                                                <br><br>
                                            </div>                                 
                                        </div>

                                        <label>Nombre:</label><br>
                                        <input type="text" class="form-control"  aria-describedby="emailHelp" name="cod_categoria" id="cod_categoria" placeholder="Código de la categoría"><br><br>
                                        <div style="text-align: center">
                                            <button type="button" class="btn btn-danger mb-2" name="boton_agregar_categoria" id="boton_borrar_categoria" onclick="deleteCategorie()">Borrar categoría</button>
                                        </div>
                                    </div>
                                </div> 
                            </fieldset>   
                        </form>   
                    </div>
                    <div id="lista_categoria"  style="margin-top: 8%">
                        <fieldset class="border p-2">
                            <h2 style="margin-top: 0px; text-align: center">Lista de categorías</h2>
                            <table class="table table-hover" style="margin-top: 3%" id="tabla_categorias">
                                <thead>
                                    <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Nombre categoria</th>
                                        <th sdcope='col'></th>
                                        <th sdcope='col'></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $categories = $db->getAllCategories();

                                    foreach ($categories as $v) {

                                        echo '<tr>'
                                        . '<td  style="color:darkred">' . '# ' . $v[0] . '</td>'
                                        . '<td>' . $v[1] . '</td>'
                                        . '<td><a href="editCategorie.php?codCategorie=' . $v[0] . '" class="link-secondary" style="display:flex" name="codCategorie" value="' . $v[0] . '">Editar</a></td>'
                                        . '<td><object type="image/svg+xml" data="images/boligrafo.svg" style="width: 25px; height: 30px"><img src="images/boligrafo.svg"></img></object></td>'
                                        . '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>          
                </div>
            </div>
            <div id="lista_productos" style="margin-right: 16.8%; margin-top: 3%">
                <fieldset class="border p-2 shadow">
                    <h2 style="margin-top: 70px; text-align: center">Lista de productos</h2>
                    <div id="busqueda_producto">
                        <form class="form-group my-3 my-lg-0">
                            <input class="form-group p-2 col-2" type="search" placeholder="Código del producto o nombre" aria-label="Search" id="buscar">
                            <button class="btn btn-outline-success p-2" type="button" name="boton_buscar_producto" id="boton_buscar_producto" onclick="searchProduct()" style="margin-left: 1%">Buscar</button>
                            <button class="btn btn-outline-success p-2" type="button" name="ver_lista_productos" id="ver_lista_productos" onclick="showListProducts()" style="margin-left: 1%; display: none">Volver al listado</button>
                        </form>
                    </div>

                    <table class="table table-hover" style="margin-top: 3%" id="tabla_productos">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Categorías</th>
                                <th sdcope='col'></th>
                                <th sdcope='col'></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $products = $db->getAllProducts($start, $productsByPage);
                            

                            foreach ($products as $v) {

                                echo '<tr>'
                                . '<td  style="color:darkred">' . '# ' . $v[0] . '</td>'
                                . '<td>' . $v[1] . '</td>'
                                . '<td>' . $v[2] . '</td>'
                                . '<td>' . $v[3] . '</td>'
                                . '<td>' . $v[4] . '</td>'
                                . '<td>' . $v[5] . '</td>'
                                . '<td><a href="editProduct.php?codProduct=' . $v[0] . '" class="link-secondary" style="display:flex" name="codProducto" value="' . $v[0] . '">Editar</a></td>'
                                . '<td><object type="image/svg+xml" data="images/boligrafo.svg" style="width: 25px; height: 30px"><img src="images/boligrafo.svg"></img></object></td>'
                                . '</tr>';
                            }
                            ?>

                        </tbody>
                    </table><br>

                    <nav aria-label="paginadoProducto" style="margin-left:40%">
                        <ul class="pagination">
                            <li class="page-item <?php echo $_GET['page'] <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link " href="userAdminPage.php?page=<?php echo $_GET['page'] - 1; ?>">Anterior</a>
                            </li>


                            <?php for ($i = 0; $i < $totalPages; $i++): ?>

                                <li class="page-item  <?php echo $_GET['page'] == $i + 1 ? 'active' : '' ?>">
                                    <a  class="page-link" href="userAdminPage.php?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>

                            <?php endfor; ?>



                            <li class="page-item <?php echo $_GET['page'] >= $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link"  href="userAdminPage.php?page=<?php echo $_GET['page'] + 1; ?>">Siguiente</a>
                            </li>
                        </ul>
                    </nav>

                    <div id="tabla_search" style="display: none">
                        <table class="table table-hover" style="margin-top: 3%" id="tabla_producto_search">
                            <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Categorías</th>
                                    <th sdcope='col'></th>
                                    <th sdcope='col'></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="tr_search">
                                    <td id="td_search_product_1"></td>
                                    <td id="td_search_product_2"></td>
                                    <td id="td_search_product_3"></td> 
                                    <td id="td_search_product_4"></td>
                                    <td id="td_search_product_5"></td>
                                    <td id="td_search_product_6"></td> 
                                    <td id="td_search_product_7"><a id="a_search_producto"class="link-secondary" style="display:flex" name="codProducto">Editar</a></td> 
                                    <td id="td_search_product_8"><object type="image/svg+xml" data="images/boligrafo.svg" style="width: 25px; height: 30px"><img src="images/boligrafo.svg"></img></object></td>
                                </tr>
                            </tbody>

                        </table>

                    </div>
                </fieldset>
            </div>

        </div>


        <?php
        require_once 'footer.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="js/responsive_header.js"></script>
        <script src="js/navFormAdmin.js"></script>
        <script src="js/uploadProduct.js"></script>
        <script src="js/addCategorie.js"></script>
        <script src="js/deleteCategorie.js"></script>


        <script>

                                function searchProduct() {

                                    var dato = document.getElementById('buscar').value;

                                    var product = String(dato);


                                    return $.ajax({
                                        url: 'api/searchProduct.php',
                                        type: 'POST',
                                        data: {
                                            producto: product

                                        },
                                        datatype: 'JSON',
                                        success:
                                                function (producto) {
                                                    let result = typeof producto === "string" ? JSON.parse(producto) : producto;
                                                    if (result.error) {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Ups!...',
                                                            text: result.msg,
                                                            confirmButtonText:
                                                                    'Continuar',
                                                        })


                                                    } else {

                                                        document.getElementById('tabla_productos').style.display = "none";
                                                        document.getElementById('ver_lista_productos').style.display = "inline";
                                                        document.getElementById('tabla_search').style.display = "inline";

                                                        document.getElementById('td_search_product_1').style.color = 'darkred';

                                                        document.getElementById('td_search_product_1').innerHTML = '# ' + producto[0][0];
                                                        document.getElementById('td_search_product_2').innerHTML = producto[0][1];
                                                        document.getElementById('td_search_product_3').innerHTML = producto[0][2];
                                                        document.getElementById('td_search_product_4').innerHTML = producto[0][3];
                                                        document.getElementById('td_search_product_5').innerHTML = producto[0][4];
                                                        document.getElementById('td_search_product_6').innerHTML = producto[0][5];

                                                        let cadCod = "editProduct.php?codProduct=" + producto[0][0];

                                                        document.getElementById('a_search_producto').setAttribute('href', cadCod);


                                                    }

                                                }
                                    })


                                }


                                function showListProducts() {
                                    document.location.reload();
                                    document.getElementById('tabla_productos').style.display = "inline";
                                    document.getElementById('ver_lista_productos').style.display = "none";
                                    document.getElementById('tabla_search').style.display = "none";

                                }


                                function deleteProduct() {

                                    Swal.fire({
                                        title: 'Estás seguro/a?',
                                        text: "¡No podrás revertir esto!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        cancelButtonText: 'Cancelar',
                                        confirmButtonText: 'Si, borralo!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            Swal.fire(
                                                    'Deleted!',
                                                    'Your file has been deleted.',
                                                    'success'
                                                    )
                                        }
                                    })
                                }



        </script>

    </body>
</html>

