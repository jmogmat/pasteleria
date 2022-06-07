<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');


if (isset($_POST['producto'])) {
    
    $product = trim($_POST['producto']);

    $db = new conect($_SESSION['rol']);

    $dataProduct = $db->adminSearchProduct($product);

    if (!empty($dataProduct)) {

        echo json_encode($dataProduct);
        return;
    } else {
        echo json_encode(['error' => '402', 'msg' => 'Producto no econtrado']);
        return;
    }
} else {
    echo json_encode(['error' => '402', 'msg' => 'No se ha encontrado un valor existente']);
        return;
}
?>



