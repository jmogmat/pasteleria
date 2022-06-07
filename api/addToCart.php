<?php

$nombre = "";
$description = "";
$precio = "";
$cantidad = "";
$id = "";
$cuantos = "";
$totalcantidad = "";
$MyCart = [];

//aqui empieza el carrito
if (isset($_SESSION['carrito']) || isset($_POST['nombre'])) {


    if (isset($_SESSION['carrito'])) {

        $myCart = $_SESSION['carrito'];

        if (isset($_POST['nombre'])) {

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $id = $_POST['id'];

            $indice = -1;

            if ($indice != -1) {
                $cuanto = $myCart[$indice]['cantidad'] + $cantidad;
                array_push($myCart, ["nombre" => $nombre, "descripcion" => $descripcion, "precio" => $precio, "cantidad" => $cuanto, "id" => $id]);
            } else {
                array_push($myCart, ["nombre" => $nombre, "descripcion" => $descripcion, "precio" => $precio, "cantidad" => $cantidad, "id" => $id]);
            }
        }
    } else {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $id = $_POST['id'];
        $myCart[] = array("nombre" => $nombre, "descripcion" => $descripcion, "precio" => $precio, "cantidad" => $cantidad, "id" => $id);
        // array_push($myCart, ["nombre" => $nombre, "descripcion" => $descripcion, "precio" => $precio, "cantidad" => $cantidad, "id" => $id]);
    }
    if (isset($_POST['cantidad'])) {

        if ($cantidad < 1) {
            $myCart[$id] = NULL;
        } else {
            $myCart[$id]['cantidad'] = $cantidad;
        }
    }
    if (isset($_POST['id2'])) {
        $id = $_POST['id2'];
        $myCart[$id] = NULL;
    }

    $_SESSION['carrito'] = $myCart;
}


//aqui termina el carrito


if (isset($_SESSION['carrito'])) {

    for ($i = 0; $i <= count($myCart) - 1; $i++) {
        if ($myCart[$i] != NULL) {
            $totalc = $myCart['cantidad'];
            $totalc++;
            $totalcantidad += $totalc;
        }
    }

}

header("location: ".$_SERVER['HTTP_REFERER']."");
?>