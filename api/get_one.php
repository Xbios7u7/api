<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../models/Producto.php';

$database = new Database();
$db = $database->connect();

$producto = new Producto($db);

$producto->id_prod = isset($_GET['id_prod']) ? $_GET['id_prod'] : die();

$stmt = $producto->fetchById($producto->id_prod);
$num = $stmt->rowCount();

if($num > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $producto_arr = array(
        "id_prod" => $row['ID_PROD'],
        "sku" => $row['SKU'],
        "nom_producto" => $row['NOM_PRODUCTO'],
        "modelo" => $row['MODELO'],
        "descripcion" => $row['DESCRIPCION'],
        "precio" => $row['PRECIO'],
        "stock" => $row['STOCK'],
        "id_categoria" => $row['ID_CATEGORIA'],
        "id_marca" => $row['ID_MARCA']
    );

    echo json_encode($producto_arr);
} else {
    echo json_encode(
        array("message" => "Product not found.")
    );
}
?>
