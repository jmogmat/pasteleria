<?php

session_start();

if (isset($_SESSION['carrito'])) {

    if (isset($_SESSION['carrito'])) {

        $carrito = $_SESSION['carrito'];

        if (isset($_POST['nombre'])) {

            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $pos = -1;

            for ($i = 0; $i <= count($carrito) - 1; $i++) {
                if ($id == $carrito[$i]['id']) {
                    
                }
            }

            if ($pos != -1) {

                $total = $carrito[$pos]['cantidad'] + $cantidad;

                $carrito[$pos] = array('id' => $id, 'nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio, 'cantidad' => $cantidad);

                $_SESSION['carrito'] = $carrito;

                echo json_encode(['success' => '202']);
                return;
            } else {

                $carrito[] = array('id' => $id, 'nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio, 'cantidad' => $cantidad);

                $_SESSION['carrito'] = $carrito;

                echo json_encode(['success' => '202']);
                return;
            }
        }
    }
} else {

    if (isset($_POST['id']) && isset($_POST['nombre'])) {

        $carrito = [];

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $carrito[] = array('id' => $id, 'nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio, 'cantidad' => $cantidad);

        $_SESSION['carrito'] = $carrito;

        echo json_encode(['success' => '202']);
        return;
    } else {
        echo json_encode(['error' => '403', 'msg' => 'No se ha podido agregar un producto al carrito!']);
        return;
    }
}


?>