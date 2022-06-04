<?php
if (session_status() == PHP_SESSION_NONE) { 
    session_start();
}
// Eliminamos los datos de la varible superglobal $_SESSION
unset($_SESSION);
// Destruimos la sessión
session_destroy();
header('location:index.php');
?>