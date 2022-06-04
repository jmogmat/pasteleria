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

    $id = $_POST['id'];

    if (isset($id)) {

        if (!$db->deleteAccountUser($id)) {
            echo json_encode(['success' => '202']);
            return;
        }
    } else {
        echo json_encode(['error' => '403', 'msg' => 'Error al procesar la solicitud']);
        return;
    }

} else {
    echo json_encode(['error' => '404', 'msg' => 'No tienes permisos para acceder a este recurso']);
    return;
}
?>

