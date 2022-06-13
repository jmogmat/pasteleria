<?php

declare(strict_types=1);

namespace functions;

require_once __DIR__ . '/../../autoload.php';

use \user\user as usuario;

class functions {

    function phone(string $numberPhone): bool {

        if (is_numeric($numberPhone)) {

            $num = trim($numberPhone);

            if (strlen($num) < 9 || strlen($num) > 9) {

                return false;
            } else {
                return true;
            }
        }
    }

    function encryptionPassword(string $password): string {

        $pass = password_hash($password, PASSWORD_DEFAULT);

        return $pass;
    }

    function validatePass(string $password, string $hash): string {

        $encryptionPass = password_verify($password, $hash);

        return $encryptionPass;
    }

    function validateEmail(string $email): bool {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Función que crea una sesion con el rol del usuario, el rol lo obtenemos de la variable que recibe como parametro, esta variable es un array con todos los datos del usuario.
     * @param string $result
     */
    function saveSessionData($result) {

       
        if (session_status() == PHP_SESSION_NONE) { // Comprobamos si NO tenemos una sessión activo
            session_start();
        }

        if (array_key_exists('img', $result)) {
            $result['img'] = "";
        }

        $_SESSION['usuario'] = json_encode(new usuario($result['id'], $result['nombre'], $result['apellido'], $result['email'], $result['telefono'], $result['direccion'], $result['ciudad'], $result['codigo_postal'], $result['provincia'], "", $result['rol_usuario'], $result['estado']));
        $_SESSION['rol'] = $result['rol_usuario'];

      
        // header("location:index.php");
    }

    function checkSession() {
      
        
        if (session_status() == PHP_SESSION_NONE) { // Comprobamos si NO tenemos una sessión activo
            session_start(); // Iniciamos o recuperamos la información de la sessión actual


            if (!isset($_SESSION['rol'])) { // Comprobamos si no existe un ROL asignado
                $_SESSION['rol'] = '3'; // Asignamos el rol por defecto, 3 es el usuario de conexión
            } 
        
            
        }
    }

    function dateDiff($date1, $date2) {
        $date1_ts = strtotime($date1);
        $date2_ts = strtotime($date2);
        $diff = $date2_ts - $date1_ts;
        return round($diff / 86400);
    }

    function isUserAnonimous($rol) {
        if ($rol == '3') {
            return true;
        }
        return false;
    }

    /**
     * Función que recibe una imagen y el tipo de producto y si todo está correcto, mueve la imagen a la carpeta correspondiente dependiendo del tipo de producto.
     * @param type $img Una imagen
     * @param type $typeProduct string, que puede ser 1 o 2, siendo 1 pasteleria y 2 panaderia.
     * @return boolean 
     * @throws RuntimeException
     */
    function uploadImageProduct(array $img, string $typeProduct): bool {

        $ok = false;

        try {

            if (!isset($_FILES['img']['error'])) {

                throw new RuntimeException('Se produjo un error en el envío del fichero.');
            }

            switch ($_FILES['img']['error']) {
                case UPLOAD_ERR_OK: break;

                case UPLOAD_ERR_NO_FILE:

                    throw new RuntimeException('No se recibió el archivo.');
                default: throw new RuntimeException('Error desconocido.');
            }

            if ($_FILES['img']['size'] > 5000000) {

                throw new RuntimeException('Tamaño del archivo demasiado grande.');
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);

//finfo_file Devuelve información sobre un archivo
            $ext = array_search(finfo_file($finfo, $_FILES['img']['tmp_name']), array('jpg' => 'image/jpeg',
                'png' => 'image/png', 'svg' => 'image/svg')
            );
            finfo_close($finfo);
// Si no es una imagen, terminamos 
            if ($ext === false) {
                throw new RuntimeException('Imagen non reconocida.');
            }


            if ($typeProduct == '1') {

                $res = move_uploaded_file($_FILES['img']['tmp_name'], __DIR__ . '/../../images/imagenes_de_pasteles/' . $_FILES['img']['name']);
                if (!$res) {
                    throw new RuntimeException('La imagen no pudo ser cambiada de directorio.');
                } else {
                    $ok = true;
                }
            } else {
                $res = move_uploaded_file($_FILES['img']['tmp_name'], __DIR__ . '/../../images/imagenes_de_pan/' . $_FILES['img']['name']);
                if (!$res) {
                    throw new RuntimeException('La imagen no pudo ser cambiada de directorio.');
                } else {
                    $ok = true;
                }
            }
            return $ok;
        } catch (RuntimeException $e) {
            echo $e->getMessage();
            return $ok;
        }
    }

    /**
     * Comprueba los campos del name de un formulario que existan y no estén vacios
     * @param type $array
     * @return boolean
     */
    function checkFieldsForm($array) {

        $ok = true;

        foreach ($array as $value) {

            if (!isset($_POST[$value]) || empty($_POST [$value])) {
                $ok = false;
            }
        }

        return $ok;
    }

    /**
     * Función que valida los valores que se introducen en el formulario para dar de alta un producto o actualizarlo. Devuelve true o false.
     * @param type string $name_product nombre del producto
     * @param type string $description decripcion del producto
     * @param type string $price precio del producto
     * @param type string $amount cantidad del producto
     */
    function validateProduct(string $name_product, string $description, string $price, string $amount): bool {

        if (!is_numeric($name_product) && !is_numeric($description) && is_numeric($price) && is_numeric($amount)) {

            if ($amount >= 0 && $amount <= 30) {

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function uploadImgUser(array $img, $ruteFileUser, $codId): string {

        $false = 0;
        $ruteImgUser = '';

        try {

            if (!isset($_FILES['user_img']['error'])) {

                throw new RuntimeException('Se produjo un error en el envío del fichero.');
            }

            switch ($_FILES['user_img']['error']) {
                case UPLOAD_ERR_OK: break;

                case UPLOAD_ERR_NO_FILE:

                    throw new RuntimeException('No se recibió el archivo.');
                default: throw new RuntimeException('Error desconocido.');
            }

            if ($_FILES['user_img']['size'] > 5000000) {

                throw new RuntimeException('Tamaño del archivo demasiado grande.');
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            $ext = array_search(finfo_file($finfo, $_FILES['user_img']['tmp_name']), array('jpg' => 'image/jpeg',
                'png' => 'image/png')
            );
            finfo_close($finfo);

            if ($ext === false) {
                throw new RuntimeException('Imagen no reconocida.');
            }

            $extension = pathinfo($_FILES['user_img']['name'], PATHINFO_EXTENSION);

            $image = $codId . '.' . $extension;

            $res = move_uploaded_file($_FILES['user_img']['tmp_name'], $ruteFileUser . '\\' . $image);

            if (!$res) {
                throw new RuntimeException('La imagen no pudo ser cambiada de directorio.');
                return $false;
            } else {

                $ruteImgUser = DIRECTORY_SEPARATOR . $ruteFileUser . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR . $ruteImgUser, $image);

                return $ruteImgUser;
            }
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }

}
?>

