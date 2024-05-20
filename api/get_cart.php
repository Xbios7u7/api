<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Incluyendo archivos necesarios
include_once '../config/Database.php';
include_once '../models/ItemCarrito.php';

// Instanciar DB y conectar
$database = new Database();
$db = $database->connect();

// Instanciar objeto ItemCarrito
$itemCarrito = new ItemCarrito($db);

// Obtener los datos de carrito
$result = $itemCarrito->read();
$num = $result->rowCount();

if ($num > 0) {
    $carrito_arr = array();
    $carrito_arr['items'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
            'id' => $id,
            'producto' => array(
                'id_prod' => $producto_id,
                'nom_producto' => $nom_producto,
                'precio' => $precio
            ),
            'cantidad' => $cantidad
        );

        array_push($carrito_arr['items'], $item);
    }

    echo json_encode($carrito_arr);
} else {
    echo json_encode(
        array('message' => 'No hay productos en el carrito.')
    );
}
?>
