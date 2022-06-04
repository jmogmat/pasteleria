<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();
//$user = json_decode($_SESSION['usuario']);

header('Content-type: application/json; charset=utf-8');

if (($_SERVER["REQUEST_METHOD"] == "POST")) {

    if (isset($_POST['emailLogin']) && isset($_POST['passLogin'])) {

        $db = new conect($_SESSION['rol']);

        $emailLogin = trim($_POST['emailLogin']);
        $passLogin = trim($_POST['passLogin']);

        if ($emailLogin != "" && $passLogin != "") {

            $result = $db->loginUser($emailLogin);

            if (is_array($result) && isset($result['password']) && isset($result['estado'])) {

                if ($result['estado'] == '1') {

                    $hash = $result['password'];

                    if (password_verify($passLogin, $hash)) {

                        $db->updateAccess($result['id']);

                        $tool->saveSessionData($result);

                        $_SESSION['rol'] = $result['rol_usuario'];

                        if ($_SESSION['rol'] == '1') {

                            echo json_encode(['success' => '202']);
                            return;
                        }

                        if ($_SESSION['rol'] == '2') {

                            echo json_encode(['success' => '202']);
                            return;
                        }
                    } else {
                        echo json_encode(['error' => '403', 'msg' => 'Varifica tu contraseña']);
                        return;
                    }
                } else {
                    echo json_encode(['error' => '403', 'msg' => 'Parece que no tienes una cuenta con nosotros, regístrate!']);
                    return;
                }
            } else {
                echo json_encode(['error' => '403', 'msg' => 'Error del sistema']);
                return;
            }
        } else {
            echo json_encode(['error' => '403', 'msg' => 'No dejes campos incompletos!']);
            return;
        }
    } else {
        echo json_encode(['error' => '403', 'msg' => 'Error al procesar la solicitud']);
        return;
    }
} echo json_encode(['error' => '404', 'msg' => 'No tienes permisos para acceder a este recurso']);
return;
?>
