<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['email_admin']) && $_POST['email_admin'] != "") {

    $email = $_POST['email_admin'];

    $db = new conect($_SESSION['rol']);

    if ($tool->validateEmail($email)) {

        $idUser = $db->getIdAdminByEmail($email);

        if ($idUser != null) {

            if ($idUser == '1') {
                echo json_encode(['error' => '402', 'msg' => 'No tienes permiso para borrar un Super Administrador!']);
                return;
            } else {
                if (!$db->removeAdmin($idUser)) {
                    echo json_encode(['success' => '202']);
                    return;
                } else {
                    echo json_encode(['error' => '402', 'msg' => 'Fallo de conexión!']);
                    return;
                }
            }
        } else {
            echo json_encode(['error' => '402', 'msg' => 'No existe ningún usuario con ese email en la base de datos!']);
            return;
        }
    } else {
        echo json_encode(['error' => '402', 'msg' => 'El email introducido no corresponde a un email valido!']);
        return;
    }
} else {
    echo json_encode(['error' => '402', 'msg' => 'No dejes el campo vacío!']);
    return;
}
?>

