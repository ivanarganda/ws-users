<?php 

require_once "./classes/autoload.php";

$conection = new Conexion;

if ( !$conection->pdo ){
    echo json_encode('noConection');
    exit();
}

$commonMethods = new MetodosComunes( $conection->pdo );

set_error_handler(function($errno, $errstr, $errfile, $errline) use ($commonMethods) {

    if (0 === error_reporting()) {

        return false;

    }
    
    $commonMethods->procesarError($errno, $errstr, $errfile, $errline);

    return $errno;
});

register_shutdown_function(function() use ($commonMethods) { // manejo de errores fatales

    $error = error_get_last();

    if ( !empty( $error ) ){

        $errno   = $error["type"];

        $errfile = $error["file"];

        $errline = $error["line"];
        
        $errstr  = $error["message"];
        
        if ($errno == E_ERROR) { // error fatal: E_ERROR == 1

            $commonMethods->procesarError($errno, $errstr, $errfile, $errline);

        } 

    }

});

?>