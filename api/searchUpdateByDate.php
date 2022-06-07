<?php

require_once(__DIR__ . '/../autoload.php');

use \functions\functions as func;
use \conectDB\conectDB as conect;

$tool = new func();

$tool->checkSession();

header('Content-type: application/json; charset=utf-8');

$date1 = $_POST['dateOne'];
$date2 = $_POST['dateTwo'];

$db = new conect($_SESSION['rol']);

if (isset($date1) == "") {

    $date1 = $date2;

    $d1 = $date2;
}

if (isset($date2) == "") {

    $date1 = $date2;
    $d2 = $date2;
}


if ($date1 != "" && $date2 != "" || $date1 != null && $date2 != null) {


    if ($updates = $db->searchUpdateByDate($date1, $date2)) {

        echo json_encode($updates);
        return;
    } else {
        echo json_encode(['error' => '402', 'msg' => 'No se ha contrado ninguna coincidencia!']);
        return;
    }
} if ($updates = $db->searchUpdateByDate($d1, $d2)) {
    echo json_encode($updates);
    return;
} else {
    echo json_encode(['error' => '402', 'msg' => 'No se ha contrado ninguna coincidencia!']);
    return;
}
?>

