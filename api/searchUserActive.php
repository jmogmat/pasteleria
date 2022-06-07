<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['userActive'])) {

    $userActive = $_POST['userActive'];

    $db = new conect($_SESSION['rol']);

    if ($userActive != "") {

        if ($user = $db->searchUserActive($userActive)) {

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

