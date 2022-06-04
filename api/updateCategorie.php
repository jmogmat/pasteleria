<?php

require_once(__DIR__ . '/../autoload.php');

use \conectDB\conectDB as conect;
use \functions\functions as func;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['nombreCategoria']) && $_POST['nombreCategoria'] != "" && isset($_POST['idCategoria']) && $_POST['idCategoria'] != "") {

    if (!is_numeric($_POST['nombreCategoria'])) {

        $db = new conect($_SESSION['rol']);

        if (!$db->updateCategorie($_POST['idCategoria'], $_POST['nombreCategoria'])) {

            echo json_encode(['success' => '202']);
            return;
        } else {
            echo json_encode(['error' => '402', 'msg' => 'No se ha podido actualizar la categoría!']);
            return;
        }
    } else {
        echo json_encode(['error' => '402', 'msg' => 'El nombre no puede ser numérico!']);
        return;
    }
} else {
    echo json_encode(['error' => '402', 'msg' => 'Campos vacios']);
    return;
}
?>



