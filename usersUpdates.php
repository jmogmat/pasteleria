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



        <div id="formularios_usuarios" class="col-auto container-flex">
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




<?php
require_once 'footer.php';
?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="js/responsive_header.js"></script>

    </body>
</html>