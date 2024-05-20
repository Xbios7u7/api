<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");

include_once '../config/Database.php';
include_once '../models/Producto.php';

$database = new Database();
$db = $database->connect();

$producto = new Producto($db);

$data = json_decode(file_get_contents("php://input"));

$producto->id_prod = $data->id_prod;
$producto->sku = $data->sku;
$producto->nom_producto = $data->nom_producto;
$producto->modelo = $data->modelo;
$producto->descripcion = $data->descripcion;
$producto->precio = $data->precio;
$producto->stock = $data->stock;
$producto->id_categoria = $data->id_categoria;
$producto->id_marca = $data->id_marca;

if($producto->update($producto->id_prod)) {
    echo json_encode(
        array("message" => "Product updated.")
    );
} else {
    echo json_encode(
        array("message" => "Product not updated.")
    );
}
?>
