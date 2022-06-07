<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['userDeleted'])) {

    $userDeleted = trim($_POST['userDeleted']);

    $db = new conect($_SESSION['rol']);

    if ($userDeleted != "") {

        if ($user = $db->searchUserDeleted($userDeleted)) {

            echo json_encode($user);
        } else {
            echo json_encode(['error' => '402', 'msg' => 'No se ha contrado ninguna coincidencia!']);
            return;
        }
    } else {
        echo json_encode(['error' => '402', 'msg' => 'No se ha contrado ninguna coincidencia!']);
        return;
    }
} else {
    echo json_encode(['error' => '402', 'msg' => 'No se ha podido establecer un valor']);
    return;
}
?>


