<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['idAdmin']) && is_numeric($_POST['idAdmin'])) {

    $idAdmin = $_POST['idAdmin'];

    $db = new conect($_SESSION['rol']);

    if ($user = $db->searchAdminById($idAdmin)) {

        echo json_encode($user);
    } else {
        echo json_encode(['error' => '402', 'msg' => 'El id del usuario introducido no existe!']);
        return;
    }
} else {
    echo json_encode(['error' => '402', 'msg' => 'El valor introducido debe ser un número']);
    return;
}
?>

