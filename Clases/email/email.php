<?php

namespace email;

require __DIR__ . "/../../vendor/autoload.php";

use \PHPMailer\PHPMailer\PHPMailer; 

class email {

    private $email;
    private $pass;
    private $xml = __DIR__ . "/../../config/correo.xml";
    private $xsd = __DIR__ . "/../../config/correo.xsd";

    function __construct() {

        $data = $this->read_confMail($this->xml, $this->xsd);

        $this->email = $data[0];
        $this->pass = $data[1];
    }

    /**
     * Función que envia un corre electorinico
     * 
     * @param string $email cadena de texto con la dirección del correo del usuario
     * @param string $body cadena de texto con la información del correo
     * @param sting $issue cadena de texto opcional con el asunto del correo
     * @return mixed Duelve true si el correo fue envia con exito, en caso contrario
     * devuelve el error
     */
    function sendEmail($email, $body, $issue = "") {


        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;  
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = $this->email; 
        $mail->Password = $this->pass;      
        $mail->SetFrom($this->email, 'Panaderia M.L');
        $mail->Subject = $issue;
        $mail->MsgHTML($body);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        
        $mail->AddAddress($email, $email);
		
        if (!$mail->Send()) {
	 echo $mail->ErrorInfo;
            return $mail->ErrorInfo;
        } else {
            return true;
        }
    }



    /**
     * Función leer los datos de conexión del correo
     * 
     * @param sting $xml cadena de texto con la ruta del xml que contiene
     * el nombre de usuarios y contraseña del correo
     * @param string $xsd cadena de texto con la ruta del xsd
     * @return array devuelve un array con los datos de
     * @throws InvalidArgumentException
     */
    function read_confMail($xml, $xsd) {

        $config = new \DOMDocument();
        $config->load($xml);
        $res = $config->schemaValidate($xsd);

        if ($res === FALSE) {
            throw new InvalidArgumentException("Error en el fichero de configuración del correo");
        }

        $data = simplexml_load_file($xml);
        $user = $data->xpath("//usuario");
        $pwd = $data->xpath("//clave");
        $resul = [];
        $resul[] = $user[0];
        $resul[] = $pwd[0];
        return $resul;
    }

}


