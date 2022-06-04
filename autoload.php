<?php

spl_autoload_register(function ($clase) {

    $file = __DIR__ . DIRECTORY_SEPARATOR . 'Clases' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $clase) . ".php";
    
   

    if ($file != "") {

        if (file_exists($file)) {

            include $file;
        }
    }
});
?>