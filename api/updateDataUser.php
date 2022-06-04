<?php
require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();
$user = json_decode($_SESSION['usuario']);

header('Content-type: application/json; charset=utf-8');

if (($_SERVER["REQUEST_METHOD"] == "POST") && !$tool->isUserAnonimous($_SESSION['rol'])) {
     
     
    $name = trim($_POST['nombre']);
    $surname = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['telefono']);
    $address = trim($_POST['direccion']);
    $city = trim($_POST['ciudad']);
    $cp = trim($_POST['codigo_postal']);
    $province = $_POST['provincia'];

    $db = new conect($_SESSION['rol']);

    if ($name == "" || $surname == "" || $phone == "") {
        echo json_encode(['err' => 403, 'msg' => 'No deje los campos nombre, usuario y teléfono vacios']);
        return;
    } else {

        if ($tool->phone($phone) == true && !empty($phone)) {
            
            if ($tool->validateEmail($email) == true) {

                $id = $user->id;

                $userRol = $user->rol;
                
                $db->updateUserData($id, $name, $surname, $email, $phone, $address, $city, $cp, $province, $userRol);
                 echo json_encode(['sucess' => 202]);
                 return;
            }
        } else{ 
        echo json_encode(['err' => 403, 'msg' => "El teléfono no es correcto"]);
        return;
        }
    }
} else {
    
    echo json_encode(['err' => 404, 'msg' => 'No tienes permisos para acceder a este recurso']);
}
?>

