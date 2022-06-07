<?php
require_once(__DIR__ . '/autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

$db = new conect($_SESSION['rol']);

$user_id = json_decode($_SESSION['usuario'])->id;

$userData = $db->getUserData($user_id);

if (!$_GET) {
    header('location:usersUpdates.php?updates=1');
}

if (!array_key_exists('updates', $_GET)) {
    $pag = $_GET['updates'];
}
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

        <?php
        $usersByPage = 5;
        $page = $db->countUpdatesUsers();
        $totalPages = $page / 5;
        $totalPages = ceil($totalPages);

        if ($_GET['updates'] > $totalPages || $_GET['updates'] <= 0) {
            header('location:usersUpdates.php?updates=1');
        }

        $start = ($_GET['updates'] - 1) * $usersByPage;
        ?> 

        <div class="container-flex m-3">
            <div class="row col-8">
                <div class="">
                    <div id="busqueda_admin" class="">
                        <form class="form-group my-3 my-lg-0" id="searchUpdate">
                            <input class="form-group col-3 p-2" type="search" placeholder="Código ID del usuario o email" aria-label="Search" name="updateUser" id="updateUser">
                            <button class="btn btn-outline-success p-2" type="button" name="btn_update" id="btn_update" style="margin-left:2%" onclick="searchUpdateUser()">Buscar</button>
                        </form>
                    </div>
                    <div class="" style="width:25%; margin-top: 1%">
                        <fieldset class="border p-2 rounded" style="margin-top: 2%">
                            <div class="calendario">
                                <div class="sombra">
                                    <div style="text-align: center">
                                        <h4>Búsqueda por fecha</h4>
                                    </div>
                                    <form class="d-flex flex-column" id="searchUpdateByDate">
                                        <label>Entre</label>
                                        <input type="date" id="fecha1" name="fecha1"><br>
                                        <label>Hasta</label>
                                        <input type="date" id="fecha2" name="fecha2"><br>
                                        <input type="button" value="Buscar actualización" id="btnUpdateByDate" class="btn btn-secondary" alt="boton de buscar" name="btnUpdateByDate" onclick="searchUpdateByDate()"style="margin-top:4%">
                                    </form>
                                </div>
                            </div>                  
                    </div>
                </div>
            </div>
        </div>   
    </div>



    <div id="table_users_updates" class="col-auto container-flex m-3" style="margin-top:2%">
        <div class="row">
            <form>
                <fieldset class="border p-2">        
                    <div class="form-group">
                        <div class="flex-container" style="display: flex">
                            <div style="margin-left: 35%"><object type="image/svg+xml" data="images/update.svg" style="width: 35px; height: 40px;"><img src="images/update.svg"></img></object></div>
                            <div style="align-content: center; margin-left: 1%"><h4 style="color:slategrey; margin:auto">Actualizaciones de usuarios</h4></div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Anterior nombre</th>
                                    <th scope="col">Anterior apellido</th>
                                    <th scope="col">Anterior email</th>
                                    <th scope="col">Anterior telefono</th>
                                    <th scope="col">Anterior dirección</th>
                                    <th scope="col">Anterior ciudad</th>
                                    <th scope="col">Anterior codigo postal</th>
                                    <th scope="col">Anterior provincia</th>
                                    <th scope="col">Anterior imagen</th>
                                    <th scope="col">Anterior password</th>
                                    <th scope="col">Anterior fecha de registro</th>


                                    <th scope="col">Nuevo nombre</th>
                                    <th scope="col">Nuevo apellido</th>
                                    <th scope="col">Nuevo email</th>
                                    <th scope="col">Nuevo telefono</th>
                                    <th scope="col">Nueva dirección</th>
                                    <th scope="col">Nueva ciudad</th>
                                    <th scope="col">Nuevo código postal</th>
                                    <th scope="col">Nueva provincia</th>
                                    <th scope="col">Nueva imagen</th>
                                    <th scope="col">Nuevo password</th>                                
                                    <th scope="col">Nueva fecha de registro</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Fecha modificación</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $usuarios = $db->getUpdatesUsers($start, $usersByPage);

                                foreach ($usuarios as $v) {

                                    echo '<tr>'
                                    . '<td>' . $v[0] . '</td>'
                                    . '<td>' . $v[1] . '</td>'
                                    . '<td>' . $v[2] . '</td>'
                                    . '<td>' . $v[3] . '</td>'
                                    . '<td>' . $v[4] . '</td>'
                                    . '<td>' . $v[5] . '</td>'
                                    . '<td>' . $v[6] . '</td>'
                                    . '<td>' . $v[7] . '</td>'
                                    . '<td>' . $v[8] . '</td>'
                                    . '<td>' . $v[9] . '</td>'
                                    . '<td>' . $v[10] . '</td>'
                                    . '<td>' . $v[11] . '</td>'
                                    . '<td style="color:blue">' . $v[12] . '</td>'
                                    . '<td style="color:blue">' . $v[13] . '</td>'
                                    . '<td style="color:blue">' . $v[14] . '</td>'
                                    . '<td style="color:blue">' . $v[15] . '</td>'
                                    . '<td style="color:blue">' . $v[16] . '</td>'
                                    . '<td style="color:blue">' . $v[17] . '</td>'
                                    . '<td style="color:blue">' . $v[18] . '</td>'
                                    . '<td style="color:blue">' . $v[19] . '</td>'
                                    . '<td style="color:blue">' . $v[20] . '</td>'
                                    . '<td style="color:blue">' . $v[21] . '</td>'
                                    . '<td style="color:blue">' . $v[22] . '</td>'
                                    . '<td style="color:blue">' . $v[23] . '</td>'
                                    . '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                        <nav aria-label="paginadoActualizacionesUsuarios" style="margin-left:40%">
                            <ul class="pagination">
                                <li class="page-item <?php echo $_GET['updates'] <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link " href="usersUpdates.php?updates=<?php echo $_GET['updates'] - 1; ?>">Anterior</a>
                                </li>


                                <?php for ($i = 0; $i < $totalPages; $i++): ?>

                                    <li class="page-item  <?php echo $_GET['updates'] == $i + 1 ? 'active' : '' ?>">
                                        <a  class="page-link" href="usersUpdates.php?updates=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>

                                <?php endfor; ?>



                                <li class="page-item <?php echo $_GET['updates'] >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link"  href="usersUpdates.php?updates=<?php echo $_GET['updates'] + 1; ?>">Siguiente</a>
                                </li>
                            </ul>
                        </nav>



                    </div>
                </fieldset>
            </form>


        </div>
    </div>

    <div id="tableUpdates" class="col-auto container-flex m-3" style="margin-top:2%; display: none">
        <div class="row">
            <form>
                <fieldset class="border p-2">        
                    <div class="form-group">
                        <div class="flex-container" style="display: flex">
                            <div style="margin-left: 35%"><object type="image/svg+xml" data="images/update.svg" style="width: 35px; height: 40px;"><img src="images/update.svg"></img></object></div>
                            <div style="align-content: center; margin-left: 1%"><h4 style="color:slategrey; margin:auto">Actualizaciones de usuarios</h4></div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Anterior nombre</th>
                                    <th scope="col">Anterior apellido</th>
                                    <th scope="col">Anterior email</th>
                                    <th scope="col">Anterior telefono</th>
                                    <th scope="col">Anterior dirección</th>
                                    <th scope="col">Anterior ciudad</th>
                                    <th scope="col">Anterior codigo postal</th>
                                    <th scope="col">Anterior provincia</th>
                                    <th scope="col">Anterior imagen</th>
                                    <th scope="col">Anterior password</th>
                                    <th scope="col">Anterior fecha de registro</th>


                                    <th scope="col">Nuevo nombre</th>
                                    <th scope="col">Nuevo apellido</th>
                                    <th scope="col">Nuevo email</th>
                                    <th scope="col">Nuevo telefono</th>
                                    <th scope="col">Nueva dirección</th>
                                    <th scope="col">Nueva ciudad</th>
                                    <th scope="col">Nuevo código postal</th>
                                    <th scope="col">Nueva provincia</th>
                                    <th scope="col">Nueva imagen</th>
                                    <th scope="col">Nuevo password</th>                                
                                    <th scope="col">Nueva fecha de registro</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Fecha modificación</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr id="tr_search_user">
                                    <td id="td_search_user_1"></td>
                                    <td id="td_search_user_2"></td>
                                    <td id="td_search_user_3"></td> 
                                    <td id="td_search_user_4"></td>
                                    <td id="td_search_user_5"></td>
                                    <td id="td_search_user_6"></td> 
                                    <td id="td_search_user_7"></td>
                                    <td id="td_search_user_8"></td>
                                    <td id="td_search_user_9"></td> 
                                    <td id="td_search_user_10"></td>
                                    <td id="td_search_user_11"></td>
                                    <td id="td_search_user_12"></td> 
                                    <td id="td_search_user_13"></td> 
                                    <td id="td_search_user_14"></td> 
                                    <td id="td_search_user_15"></td>
                                    <td id="td_search_user_16"></td>
                                    <td id="td_search_user_17"></td>
                                    <td id="td_search_user_18"></td> 
                                    <td id="td_search_user_19"></td>
                                    <td id="td_search_user_20"></td>
                                    <td id="td_search_user_21"></td> 
                                    <td id="td_search_user_22"></td>
                                    <td id="td_search_user_23"></td>
                                    <td id="td_search_user_24"></td> 
                                </tr>
                            </tbody>
                        </table>

                      



                    </div>
                </fieldset>
            </form>


        </div>
    </div>





    <?php
    require_once 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/responsive_header.js"></script>
    <script src="js/searchUpdateByDate.js"></script>

</body>
</html>