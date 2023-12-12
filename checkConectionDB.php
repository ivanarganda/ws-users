<?php 


// Set CORS headers to allow access from any origin (not recommended for production)
header("Access-Control-Allow-Origin: *");

// You can also specify allowed origins explicitly like this:
// header("Access-Control-Allow-Origin: http://example.com");

// Allow additional HTTP methods besides GET and POST
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Allow specific headers in the actual request (adjust these to your needs)
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Allow cookies to be included in cross-origin requests
header("Access-Control-Allow-Credentials: true");

require_once "./classes/autoload.php";

$conection = new Conexion;

if ( !$conection->pdo ){
    echo json_encode('noConection');
    exit();
}

echo json_encode('Conection');

?>