<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../models/Marca.php';

$database = new Database();
$db = $database->connect();

$marca = new Marca($db);

// Obtener todas las marcas
$stmt = $marca->fetchAll();
$num = $stmt->rowCount();

if($num > 0) {
    $marcas_arr = array();
    $marcas_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $marca_item = array(
            "id_marca" => $ID_MARCA,
            "nom_marca" => $NOM_MARCA
        );

        array_push($marcas_arr["records"], $marca_item);
    }

    echo json_encode($marcas_arr);
} else {
    echo json_encode(
        array("message" => "No brands found.")
    );
}
?>
