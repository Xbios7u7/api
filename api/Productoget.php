<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../models/Producto.php';

$database = new Database();
$db = $database->connect();

$producto = new Producto($db);

// Fetch all products
$stmt = $producto->fetchAll();
$num = $stmt->rowCount();

if ($num > 0) {
    $productos_arr = array();
    $productos_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $producto_item = array(
            "id_prod" => $ID_PROD,
            "sku" => $SKU,
            "nom_producto" => $NOM_PRODUCTO,
            "modelo" => $MODELO,
            "descripcion" => $DESCRIPCION,
            "precio" => $PRECIO,
            "stock" => $STOCK,
            "id_categoria" => $ID_CATEGORIA,
            "id_marca" => $ID_MARCA
        );

        array_push($productos_arr["records"], $producto_item);
    }

    echo json_encode($productos_arr);
} else {
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>
