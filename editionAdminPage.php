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
    <?php
    require_once 'head.php';
    ?>
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
        <div id="formularios_administrador" class="container-flex" style="margin-left: 25%; margin-top: 3%;">
            <div class="row">
                <div class="col-md-4">
                    <form id="form_add_admin">
                        <fieldset class="border p-2">
                            <div class="form-group">
                                <div class="flex-container" style="display: flex">
                                    <div style="margin-left: 25%"><object type="image/svg+xml" data="images/signo_mas.svg" style="width: 25px; height: 30px"><img src="images/signo_mas.svg"></img></object></div>
                                    <div style="align-content:center"><h4 style="color: royalblue; margin-left: 10px">Agregar un administrador/a</h4><br><br></div>
                                </div>
                                <label>Email:</label><br>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" name="email_usuario_no_admin" id="email_usuario_no_admin" placeholder="Email del usuario/a"><br><br>
                                <div style="text-align: center">
                                    <button type="button" class="btn btn-primary mb-2" name="boton_agregar_admin" id="boton_agregar_admin" onclick="addNewAdmin()">Agregar administrador</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <div id="form_delete_admin" class="col-md-4">
                    <form id="form_remove_admin">
                        <fieldset class="border p-2">        
                            <div class="form-group">
                                <div class="flex-container" style="display: flex">
                                    <div style="margin-left: 25%"><object type="image/svg+xml" data="images/papelera.svg" style="width: 25px; height: 30px;"><img src="images/papelera.svg"></img></object></div>
                                    <div style="align-content: center"><h4 style="color:red; margin-left: 10px">Eliminar un administrador/a</h4><br><br></div>
                                </div>
                                <label>Email:</label><br>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" name="email_admin" id="email_admin" placeholder="Email del usuario/a"><br><br>
                                <div style="text-align: center">
                                    <button type="button" class="btn btn-danger mb-2" name="boton_eliminar_admin" id="boton_eliminar_admin" onclick="removeAdmin()">Eliminar administrador</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <br><br>
            <div id="lista_admin" class="col-md-5" style="width:66.4%">
                <fieldset class="border p-2">
                    <h2 style="margin-top: 70px; text-align: center">Lista de usuarios administradores</h2>
                    <div id="busqueda_admin" style="margin-top:3%">
                        <form class="form-group my-3 my-lg-0" id="search_admin">
                            <input class="form-group col-4" type="search" placeholder="Código ID del usuario administrador o email" aria-label="Search" name="admin" id="admin" style="padding:0.5%">
                            <button class="btn btn-outline-success" type="button" name="boton_buscar_admin" id="boton_buscar_admin" style="margin-left:2%" onclick="searchAdmin()">Buscar</button>
                        </form>
                    </div>
                    <table class="table table-hover" style="margin-top:3%" id="tabla_admin">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $usersAdmins = $db->getAllAdmins();

                            foreach ($usersAdmins as $v) {

                                echo '<tr>'
                                . '<td  style="color:darkred">' . '# ' . $v['id'] . '</td>'
                                . '<td>' . $v['nombre'] . '</td>'
                                . '<td>' . $v['email'] . '</td>'
                                . '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <div id="tabla_search_admin" style="display: none">
                        <table class="table table-hover" style="margin-top: 3%" id="tabla_admin_search">
                            <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="tr_search_admin">
                                    <td id="td_search_admin_1"></td>
                                    <td id="td_search_admin_2"></td>
                                    <td id="td_search_admin_3"></td> 
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
        <script src="js/addNewAdmin.js"></script>
        <script src="js/removeAdmin.js"></script>
        <script src="js/searchAdmin.js"></script>
    </body>
</html>
