<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['email_usuario_no_admin']) && $_POST['email_usuario_no_admin'] != "") {

    $email = $_POST['email_usuario_no_admin'];

    $db = new conect($_SESSION['rol']);

    if ($tool->validateEmail($email)) {

        if (!$db->addNewAdmin($email)) {
            echo json_encode(['success' => '202']);
            return;
        } else {
            echo json_encode(['error' => '402', 'msg' => 'Fallo de conexión!']);
            return;
        }
    } else {
        echo json_encode(['error' => '402', 'msg' => 'El email introducido no es valido!']);
        return;
    }
} else {
    echo json_encode(['error' => '402', 'msg' => 'No dejes el campo vacío!']);
    return;
}
?>



