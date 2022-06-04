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
        <style>
            .user_nav:hover{
                background-color: rgb(10,10,10,0.2);
                transition: background-color 0.1;
                color: white;
            }

            #imgUsuario{
                border-radius:150px;
            }
        </style>
    </head>
    <body style="background-color: rgb(246,246,246)">
        <div class="container-flex">
            <?php require_once 'header.php'; ?>
        </div>
        <div style="margin-top: 2.5%;"></div>
        <div style="text-align: center; justify-content: center; align-items: center;" class="shadow">
            <div style="margin: auto; background-color: rgba(0,0,0,0.1); height: 120px; "><br>
                <h2 style="color: rgba(24,23,28,0.7)" ">Mi cuenta</h2>
                <p style="color:gray">DETALLES DE LA CUENTA</p>
            </div>
        </div>
        <div class="container" style="margin-top: 2%;">
            <div class="row row-cols-2">
                <div class="col-3">
                    <div id="img_user">

                        <?php
                        $imgUsuario = $db->getImgUser($user_id); //Obtenemos la ruta completa donde se encuentra el fichero

                        $extension = pathinfo($imgUsuario, PATHINFO_EXTENSION); //Obtenemos la extensión del fichero

                        $imagen = 'imgUsers/codigoUsuario_' . $user_id . '/' . $user_id . '.' . $extension; //Creamos la ruta concatenando los valores para poder ponerlos en el atributo src de la imagen del usuario

                        if ($imgUsuario == "") {
                            ?>
                            <div class="account-user circle">
                                <span class="image mr-half inline-block" style="text-align: center">
                                    <div><object type="image/svg+xml" data="imgUsers//avatar.svg" style="width: 70; height: 70">
                                            <img src="/img_users/avatar.svg"></img>
                                        </object>
                                    </div>
                                </span>
                            </div></div>
                        <?php
                    } else {
                        ?>

                        <div class="account-user circle">
                            <span class="image mr-half inline-block" style="text-align: center">
                                <div><object type="image/svg+xml" data="<?php $imagen; ?>" >
                                        <img id="imgUsuario" src="<?php echo $imagen; ?>" style="width: 190px; height: 190px" class="shadow" alt="imagen_de_usuario"></img>
                                    </object>
                                </div>
                            </span>
                        </div></div><br>

                <?php } ?>


                <div id="nav_user"> 
                    <div class="row vertical-tabs" style="display: flex;">
                        <div class="large-3 col-border">
                            <div class="">
                                <?php
                                echo '<div style="text-align:center"><h3>' . $userData['nombre'] . " " . $userData['apellido'] . '</h3></div>';
                                ?>
                            </div>
                        </div>                        
                        <div>
                            <fieldset class="border p-2" style="border-radius: 5px">
                                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                                    <a class="user_nav nav-link" id="escritorio" role="tab"  onclick="dashboardProfileUser()">Escritorio</a>
                                    <a class="user_nav nav-link" id="cuenta" role="tab" data-toggle="modal" data-target="#modal1">Editar cuenta</a>
                                    <a class="user_nav nav-link" id="pedidos"  role="tab">Pedidos</a>
                                    <a class="user_nav nav-link" id="direccion"  role="tab"  onclick="event.preventDefault();addressBilling()">Dirección</a>
                                    <a class="user_nav nav-link" id="borrar_imagen"  role="tab" onclick="deleteImgUser()">Eliminar imagen de perfil</a>
                                    <input type="text" id="idUsuario" value="<?php echo $user_id; ?>" style="display:none">
                                    <a class="user_nav nav-link" id="eliminar_cuenta"  role="tab" onclick="deleteAccountUser()">Eliminar cuenta</a>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <div id="contenido"  class="">
                <fieldset class="border p-2" style="border-radius: 5px">
                    <div id="contenido">
                        <div id="dashboardUser">
                            <p>Hola <?php echo '<b>' . $userData['nombre'] . " " . $userData['apellido'] . '</b>' ?>! Desde el escritorio de tu cuenta puedes ver tus pedidos recientes, gestionar tus direcciones de envío y facturación, editar tu contraseña y los detalles de tu cuenta.</p>
                            <div class="row justify-content-around">                               
                                <button id="btn2"  class="btn btn-outline-secondary btn-xs col-2" data-toggle="modal" data-target="#modal1">Editar cuenta</button>
                                <button id="btn3"  class="btn btn-outline-secondary btn-xs col-2">Pedidos</button> 
                                <button id="btn4"  class="btn btn-outline-secondary btn-xs col-2" onclick="addressBilling()">Dirección</button>
                                <button id="btn4"  class="btn btn-outline-secondary btn-xs col-2" onclick="logout()">Salir</button>
                            </div>
                        </div>

                        <div id="editProfileUser" class="container">
                            <div class="modal" tabindex="-1" id="modal1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2>Editar cuenta</h2>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form_edit_profile">
                                                <div class="form-group">
                                                    <p>Nombre visible: <?php echo '<b>' . $userData['nombre'] . " " . $userData['apellido'] . '</b>'; ?></p><br>
                                                    <div class="row row-cols-2">
                                                        <div style="margin-top: 2%">
                                                            <label style="font-weight: bold">Nombre *</label><br>
                                                            <input type="text" id="user_name" name="user_name" value="<?php echo $userData['nombre']; ?>" style="padding: 1.8%">   
                                                        </div>
                                                        <div style="margin-top: 2%">
                                                            <label style="font-weight: bold">Apellido *</label><br>
                                                            <input type="text" id="surnameUser" name="surnameUser" value="<?php echo $userData['apellido']; ?>" style="padding: 1.8%">
                                                        </div>
                                                    </div><br>
                                                    <label style="font-weight: bold">Email *</label><br>
                                                    <input type="text" id="user_email" name="user_email" value="<?php echo $userData['email']; ?>" style="padding: 1%; width: 100%"><br><br>
                                                    <label style="font-weight: bold">Telefono *</label><br>
                                                    <input type="text" id="user_phone" name="user_phone" value="<?php echo $userData['telefono']; ?>" style="padding: 1%; width: 100%"><br><br>
                                                    <div style='display: flex;'>
                                                        <div class="col-5 my-3 p-3">
                                                            <label class="form-label">Subir una imagen:</label>
                                                            <input id="user_img" class="form-control form-control-sm " type="file" name="user_img" style="width: 250%"><br>
                                                            <label style="color: darkgrey">Formato de imagen permitido: svg, jpeg, png.</label><br>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p style="font-weight: bold">CAMBIO DE CONTRASEÑA</p>
                                                        <label>Contraseña actual (déjalo en blanco para no cambiarla)</label><br>
                                                        <input type="password" id="currentPWD" name="currentPWD" style="width: 100%"><br><br>
                                                        <label>Nueva contraseña (déjalo en blanco para no cambiarla)</label><br>
                                                        <input type="password" id="newPWD" name="newPWD" style="width: 100%"><br><br>
                                                        <label>Confirmar nueva contraseña (déjalo en blanco para no cambiarla)</label><br>
                                                        <input type="password" id="newPWD2" name="newPWD2" style="width: 100%"><br><br><br>
                                                    </div>
                                                    <input type="button" id="btn_editProfileUser" name="btn_editProfileUser" value="GUARDAR LOS CAMBIOS" class="btn btn-secondary" onclick="updateAccountUser()">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="usersOrders" style="display: none"></div>

                    <div id="addressBilling" style="display: none">
                        <label>Las siguientes direcciones se utilizarán por defecto en la página de pago.</label><br><br>
                        <div>
                            <label style="font-weight: bold">Dirección de facturación y envio</label><br><br>
                            <a id="a_billing" style="text-decoration: none; color: grey;" data-toggle="modal" data-target="#modal2">Editar</a>
                            <p><?php echo '<i>' . $userData['nombre'] . " " . $userData['apellido'] . '</i>'; ?></p>
                            <p><?php echo '<i>' . $userData['direccion'] . " CP: " . $userData['codigo_postal'] . " " . $userData['ciudad'] . '</i>'; ?></p>
                            <p><?php echo '<i>' . $userData['provincia'] . '</i>'; ?></p>
                        </div>
                    </div>

                    <div id="editAddressUser" class="container">
                        <div class="modal" tabindex="-1" id="modal2">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>Editar dirección</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form_edit_address">
                                            <div class="form-group">
                                                <label style="font-weight: bold">Dirección *</label><br>
                                                <input type="text" id="user_address" name="user_address" value="<?php echo $userData['direccion']; ?>" style="padding: 1%; width: 100%"><br><br>
                                                <label style="font-weight: bold">Ciudad *</label><br>
                                                <input type="text" id="city" name="city" value="<?php echo $userData['ciudad']; ?>" style="padding: 1%; width: 100%"><br><br>
                                                <div class="row row-cols-2">
                                                    <div>
                                                        <label style="font-weight: bold">Codigo Postal *</label><br>
                                                        <input type="text" id="user_postal_code" name="user_postal_code" value="<?php echo $userData['codigo_postal']; ?>" style="padding: 2%">   
                                                    </div>
                                                    <div>
                                                        <label style="font-weight: bold">Provincia *</label><br>
                                                        <select name="province" id="province" class="form-select form-select-sm mb-2 mt-1" >
                                                            <option value="A Coruña">A Coruña</option>
                                                            <option value="Lugo">Lugo</option>
                                                            <option value="Ourense">Ourense</option>
                                                            <option value="Pontevedra">Pontevedra</option>
                                                        </select><br><br>
                                                    </div>
                                                </div><br>
                                                <input type="button" id="btn_editAddress" name="btn_editAddress" value="GUARDAR LOS CAMBIOS" class="btn btn-secondary" onclick="updateAddressUser()">                                                     
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </fieldset>
    </div>            
</div>
</div>
<?php
require_once 'footer.php';
?>

<!-- JavaScript Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="js/dashboardUser.js"></script>
<script src="js/updateAccountUser.js"></script>
<script src="js/responsive_header.js"></script>
<script src="js/updateAddressUser.js"></script>
<script src="js/deleteImgUser.js"></script>
<script src="js/deleteAccountUser.js"></script>

</body>
</html>


