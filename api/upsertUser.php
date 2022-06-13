<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

$arrayCampos = array();

$arrayCampos = ['name', 'surname', 'email', 'phone', 'pass1', 'pass2'];

if ($tool->checkFieldsForm($arrayCampos)) {

    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $pass1 = trim($_POST['pass1']);
    $pass2 = trim($_POST['pass2']);

    $db = new conect($_SESSION['rol']);

    if ($tool->phone($phone) == true && !empty($phone)) {

        $pass = $tool->encryptionPassword($pass1);

        if ($pass1 == $pass2) {

            if ($tool->validateEmail($email) == true) {

                if (!$db->registerUser($name, $surname, $email, $phone, $pass)) {

                    echo json_encode(['success' => '202']);
                    return;
                }

                //$id = $db->getLastUserId();
                //$db->sendMailConfirmationRegister($id); No podemos aplicar esto debido a las restricciones de google gmail
            } else {
                echo json_encode(['error' => '403', 'msg' => 'El email introducido no es valido!']);
                return;
            }
        } else {
            echo json_encode(['error' => '403', 'msg' => 'Las contraseñas no coinciden!']);
            return;
        }
    } else {
        echo json_encode(['error' => '403', 'msg' => 'Verifique el campo del teléfono!']);
        return;
    }

    echo json_encode(['error' => '403']);
    return;
} else {
    echo json_encode(['error' => '402', 'msg' => 'Campos incompletos']);
    return;
}
?>

