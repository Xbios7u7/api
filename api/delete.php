<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");

include_once '../config/Database.php';
include_once '../models/Producto.php';

$database = new Database();
$db = $database->connect();

$producto = new Producto($db);

$data = json_decode(file_get_contents("php://input"));

$producto->id_prod = $data->id_prod;

if($producto->delete($producto->id_prod)) {
    echo json_encode(
        array("message" => "Product deleted.")
    );
} else {
    echo json_encode(
        array("message" => "Product not deleted.")
    );
}
?>
