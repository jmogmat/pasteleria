<?php

session_start();
header('Content-type: application/json; charset=utf-8');
unset($_SESSION['carrito']);
echo json_encode(['success' => '202']);
return;
?>