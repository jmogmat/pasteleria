<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();
$user = json_decode($_SESSION['usuario']);

header('Content-type: application/json; charset=utf-8');

if (($_SERVER["REQUEST_METHOD"] == "POST") && !$tool->isUserAnonimous($_SESSION['rol'])) {

    $db = new conect($_SESSION['rol']);

    $id = $user->id;

    if ($_POST['user_address'] == "" || $_POST['user_postal_code'] == "" || $_POST['city'] == "") {
        echo json_encode(['error' => '403', 'msg' => 'No deje campos vacios!']);
        return;
    } else {
        if (strlen($_POST['user_postal_code']) != '5' && !is_numeric($_POST['user_postal_code'])) {
            echo json_encode(['error' => '403', 'msg' => 'El código postal introducido no es valido!']);
            return;
        }

        if (!$db->updateAddressUser(trim($_POST['user_address']), trim($_POST['city']), trim($_POST['user_postal_code']), $_POST['province'], $id)) {
            echo json_encode(['success' => '202']);
            return;
        } else {
            echo json_encode(['error' => '403', 'msg' => 'Error de conexión!']);
            return;
        }
    }
} else {
    echo json_encode(['error' => '404', 'msg' => 'No tienes permisos para acceder a este recurso']);
    return;
}
?>

