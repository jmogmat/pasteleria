<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['nombre_categoria']) && $_POST['nombre_categoria'] != "") {

    $nameCategorie = $_POST['nombre_categoria'];

    $db = new conect($_SESSION['rol']);

    if (!is_numeric($nameCategorie)) {

        if ($db->addCategorie($nameCategorie)) {
            echo json_encode(['success' => '202']);
            return;
        } else {
            echo json_encode(['error' => '402', 'msg' => 'No se ha podido insertar una nueva categoría!']);
            return;
        }
    } else {
        echo json_encode(['error' => '402', 'msg' => 'El nombre no puede ser numérico!']);
        return;
    }

    $db = new conect($_SESSION['rol']);
} else {
    echo json_encode(['error' => '402', 'msg' => 'No dejes el campo vacío!']);
    return;
}
?>


