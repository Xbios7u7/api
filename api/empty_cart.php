<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Incluyendo archivos necesarios
include_once '../config/Database.php';
include_once '../models/ItemCarrito.php';

// Instanciar DB y conectar
$database = new Database();
$db = $database->connect();

// Instanciar objeto ItemCarrito
$itemCarrito = new ItemCarrito($db);

// Vaciar el carrito
if($itemCarrito->emptyCart()) {
    echo json_encode(
        array('message' => 'Carrito vaciado exitosamente')
    );
} else {
    echo json_encode(
        array('message' => 'Error al vaciar el carrito')
    );
}
?>
