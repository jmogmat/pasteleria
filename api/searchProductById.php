<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

$arrayFields = array();

$arrayFields = ['codigoTipoProducto', 'codigoProducto', 'nombreProducto', 'descripcion', 'precio', 'cantidad', 'categoria'];

if (isset($_POST['idProducto']) && is_numeric($_POST['idProducto'])) {
    
    $idProduct = $_POST['idProducto'];

    $db = new conect($_SESSION['rol']);

    $dataProduct = $db->adminSearchProductById($idProduct);

    if (!empty($dataProduct)) {

        echo json_encode($dataProduct);
        return;
    } else {
        echo json_encode(['error' => '402', 'msg' => 'El id del producto no existe']);
        return;
    }

    /* echo json_encode(['success' => '202']);
      return; */
} else {
    echo json_encode(['error' => '402', 'msg' => 'El valor introducido debe ser un número']);
        return;
}
?>



