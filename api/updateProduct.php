<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

$arrayFields = array();

$arrayFields = ['codigoTipoProducto', 'codigoProducto', 'nombreProducto', 'descripcion', 'precio', 'cantidad', 'categoria'];

if ($tool->checkFieldsForm($arrayFields)) {

    $codeTypeProduct = $_POST['codigoTipoProducto'];
    $idProduct = $_POST['codigoProducto'];
    $nameProduct = trim($_POST['nombreProducto']);
    $description = trim($_POST['descripcion']);
    $price = trim($_POST['precio']);
    $amount = trim($_POST['cantidad']);
    $categorie = $_POST['categoria'];

    $db = new conect($_SESSION['rol']);

    $currentRute = __DIR__;

    $ruteCakes = 'images\imagenes_de_pasteles\\';
    $ruteBreads = 'images\imagenes_de_pan\\';

    $ruteModify1 = str_replace('api', $ruteCakes, $currentRute);
    $ruteModify2 = str_replace('api', $ruteBreads, $currentRute);

    $ruteImg1 = $ruteModify1 . $_FILES['img']['name'];
    $ruteImg2 = $ruteModify2 . $_FILES['img']['name'];

    if ($tool->validateProduct($nameProduct, $description, $price, $amount)) {

        if ($_FILES['img']['name'] != "") {

            if ($tool->uploadImageProduct($_FILES['img'], $codeTypeProduct)) {

                if ($codeTypeProduct == '1') { //El codigo 1 corresponde al tipo de producto de pasteleria, el 2 al de panaderia
                    if (!$db->updateProduct($idProduct, $nameProduct, $description, $price, $amount, $categorie, $ruteImg1)) {

                        echo json_encode(['success' => '202']);
                        return;
                    } else {
                        echo json_encode(['error' => '402', 'msg' => 'Fallo en la conexión']);
                        return;
                    }
                } else {

                    if (!$db->updateProduct($idProduct, $nameProduct, $description, $price, $amount, $categorie, $ruteImg2)) {

                        echo json_encode(['success' => '202']);
                        return;
                    } else {
                        echo json_encode(['error' => '402', 'msg' => 'Fallo en la conexión']);
                        return;
                    }
                }
            } else {
                echo json_encode(['error' => '402', 'msg' => 'Error en la subida del fichero']);
                return;
            }
        } else {

            if (!$db->updateProduct($idProduct, $nameProduct, $description, $price, $amount, $categorie, $ruteImg = "")) {
                echo json_encode(['success' => '202']);
                return;
            } else {
                echo json_encode(['error' => '402', 'msg' => 'Fallo en la conexión']);
                return;
            }
        }
    } else {
        echo json_encode(['error' => '402', 'msg' => 'Algún campo introducido no es valido']);
        return;
    }
} else {
    echo json_encode(['error' => '402', 'msg' => 'Campos vacios']);
    return;
}
?>


