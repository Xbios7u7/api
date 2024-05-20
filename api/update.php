<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Incluyendo archivos necesarios
include_once '../config/Database.php';
include_once '../models/ItemCarrito.php';

// Instanciar DB y conectar
$database = new Database();
$db = $database->connect();

// Instanciar objeto ItemCarrito
$itemCarrito = new ItemCarrito($db);

// Obtener los datos enviados
$data = json_decode(file_get_contents("php://input"));

$itemCarrito->id = $data->id;
$itemCarrito->cantidad = $data->cantidad;

if($itemCarrito->updateQuantity()) {
    echo json_encode(
        array('message' => 'Cantidad actualizada exitosamente')
    );
} else {
    echo json_encode(
        array('message' => 'Error al actualizar la cantidad')
    );
}
?>
