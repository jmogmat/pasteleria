<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['cod_categoria']) || $_POST['cod_categoria']) {

    $codCategorie = trim($_POST['cod_categoria']);

    $db = new conect($_SESSION['rol']);

    if (is_numeric($codCategorie)) {

        if (!$db->deleteCategorie($codCategorie)) {
            echo json_encode(['success' => '202']);
            return;
        } else {
            echo json_encode(['error' => '402', 'msg' => 'No se ha podido insertar una nueva categoría!']);
            return;
        }
    } else {
        echo json_encode(['error' => '402', 'msg' => 'Introduce un número!']);
        return;
    }
} else {
    echo json_encode(['error' => '402', 'msg' => 'No se ha podido establecer un valor para la solicitud!']);
    return;
}
?>

