<?php 

require_once "conDB/credentials.php";

function loadClass( $classname ){

    require_once $classname . ".php";

}

spl_autoload_register("loadClass");

?>