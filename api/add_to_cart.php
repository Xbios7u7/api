<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Incluyendo archivos necesarios
include_once '../config/Database.php';
include_once '../models/Carrito.php';
include_once '../models/ItemCarrito.php';

// Instanciar DB y conectar
$database = new Database();
$db = $database->connect();

// Instanciar objetos
$carrito = new Carrito($db);
$itemCarrito = new ItemCarrito($db);

// Obtener los datos enviados
$data = json_decode(file_get_contents("php://input"));

if(isset($data->items) && !empty($data->items)) {
    $carrito->created_at = date('Y-m-d H:i:s');
    $carrito->updated_at = date('Y-m-d H:i:s');

    if($carrito->create()) {
        $carrito_id = $db->lastInsertId();

        foreach ($data->items as $item) {
            $itemCarrito->carrito_id = $carrito_id;
            $itemCarrito->producto_id = $item->id_prod;
            $itemCarrito->cantidad = $item->cantidad;
            if($itemCarrito->create()) {
                continue;
            } else {
                echo json_encode(
                    array('message' => 'Error al agregar item al carrito')
                );
                return;
            }
        }

        echo json_encode(
            array('message' => 'Carrito creado exitosamente')
        );
    } else {
        echo json_encode(
            array('message' => 'Error al crear carrito')
        );
    }
} else {
    echo json_encode(
        array('message' => 'No items found in request')
    );
}
?>
