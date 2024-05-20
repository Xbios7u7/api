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

// Obtener los datos enviados
$data = json_decode(file_get_contents("php://input"));

// Establecer ID para eliminar
$itemCarrito->id = $data->id;

// Eliminar producto del carrito
if($itemCarrito->delete()) {
    echo json_encode(
        array('message' => 'Producto eliminado del carrito')
    );
} else {
    echo json_encode(
        array('message' => 'Error al eliminar el producto del carrito')
    );
}
?>
