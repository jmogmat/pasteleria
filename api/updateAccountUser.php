<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();
$user = json_decode($_SESSION['usuario']);

header('Content-type: application/json; charset=utf-8');

if (($_SERVER["REQUEST_METHOD"] == "POST") && !$tool->isUserAnonimous($_SESSION['rol'])) {

    $id = $user->id;
    $name = trim($_POST['user_name']);
    $surname = trim($_POST['surnameUser']);
    $email = trim($_POST['user_email']);
    $phone = trim($_POST['user_phone']);
    $boolean = false;

    $db = new conect($_SESSION['rol']);

    $dataUser = $db->getUserData($id);

    $pwd = $dataUser['password'];
    $ruteImgUser = $dataUser['imagen'];

    $currentRute = __DIR__;
    $ruteFileUser = 'imgUsers\codigoUsuario_' . $id;
    $ruteModify = str_replace('api', $ruteFileUser, $currentRute);

    if ($_POST['currentPWD'] != "" && $_POST['newPWD'] != "" && $_POST['newPWD2'] != "") {

        $hash = $dataUser['password'];

        if (password_verify($_POST['currentPWD'], $hash)) {

            if ($_POST['newPWD'] === $_POST['newPWD2']) {

                $pwd = password_hash($_POST['newPWD'], PASSWORD_DEFAULT);

                $boolean = true;
            } else {
                echo json_encode(['error' => '403', 'msg' => 'Las nuevas contraseñas no coinciden!']);
                return;
            }
        } else {
            echo json_encode(['error' => '403', 'msg' => 'Verifique las contraseñas!']);
            return;
        }
    } else if ($_POST['currentPWD'] == "" && $_POST['newPWD'] != "" && $_POST['newPWD2'] != "" || $_POST['currentPWD'] == "" && $_POST['newPWD'] == "" && $_POST['newPWD2'] != "" || $_POST['currentPWD'] == "" && $_POST['newPWD'] != "" && $_POST['newPWD2'] == "" || $_POST['currentPWD'] != "" && $_POST['newPWD'] == "" && $_POST['newPWD2'] == "" || $_POST['currentPWD'] != "" && $_POST['newPWD'] == "" && $_POST['newPWD2'] != "" || $_POST['currentPWD'] != "" && $_POST['newPWD'] != "" && $_POST['newPWD2'] == "") {

        echo json_encode(['error' => '403', 'msg' => 'Verifique las contraseñas!']);
        return;
    } if ($_POST['currentPWD'] == "" && $_POST['newPWD'] == "" && $_POST['newPWD2'] == "" || $boolean == true) {

        if ($name == "" || $surname == "" || $email == "" || $phone == "") {

            echo json_encode(['error' => '403', 'msg' => 'No deje campos vacios!']);
            return;
        } else {

            if ($tool->phone($phone) == true) {

                if ($tool->validateEmail($email) == true) {

                    if ($_FILES['user_img']['name'] != "") {

                        if (!file_exists($ruteModify)) {
                            
                            mkdir($ruteModify, 0777, true);
                        }

                        if (is_string($rutaImagen = $tool->uploadImgUser($_FILES['user_img'], $ruteModify, $id))) {
                     
                                if (!$db->updateAccountUser($id, $name, $surname, $email, $phone, $pwd, $rutaImagen)) {

                                    echo json_encode(['success' => '202']);
                                    return;
                                } else {
                                    echo json_encode(['error' => '403', 'msg' => 'Error de conexión!']);
                                    return;
                                }
                            
                        } else {
                            echo json_encode(['error' => '403', 'msg' => 'Error en la subida del fichero!']);
                            return;
                        }
                    } else {
                        if (!$db->updateAccountUser($id, $name, $surname, $email, $phone, $pwd, $ruteImgUser)) {
                            echo json_encode(['success' => '202']);
                            return;
                        } else {
                            echo json_encode(['error' => '403', 'msg' => 'Error de conexión!']);
                            return;
                        }
                    }
                } else {
                    echo json_encode(['error' => '403', 'msg' => 'El email introducido no es valido!']);
                    return;
                }
            } else {
                echo json_encode(['error' => '403', 'msg' => 'El teléfono introducido no es correcto!']);
                return;
            }
        }
    }
} else {
    echo json_encode(['error' => '404', 'msg' => 'No tienes permisos para acceder a este recurso']);
    return;
}
?>
