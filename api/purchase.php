<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

if (isset($_SESSION['carrito'])) {

    $db = new conect($_SESSION['rol']);

    if (isset($_SESSION['rol']) && $_SESSION['rol'] != '3') {

        if ($_SESSION['rol'] == '2') {

            $client = json_decode($_SESSION['usuario']);

            foreach ($client as $key => $v) {

                if (!$db->userOrder($v['id'], $_SESSION['carrito'])) {

                    echo json_encode(['success' => '202']);
                    return;
                } else {
                    echo json_encode(['error' => '402', 'msg' => 'No se ha podido realizar el pedido']);
                    return;
                }
            }
        }
    } echo json_encode(['error' => '402', 'msg' => 'Registrate o inicia sesión para realizar el pedido!']);
    return;
} else {

    echo json_encode(['error' => '402', 'msg' => '']);
    return;
}
?>


