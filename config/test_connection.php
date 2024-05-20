<?php
// Verificar conexión a la base de datos
include_once 'Database.php';
$database = new Database();
$db = $database->connect();
if ($db) {
    echo "Conexión exitosa a la base de datos mysql.<br>";
} else {
    echo "Error en la conexión a la base de datos.<br>";
    exit;
}

// URL de la API
$api_url = "http://localhost:8000/api/Productoget.php";


// Verificar si cURL está habilitado
if (!function_exists('curl_init')) {
    die('cURL no está habilitado. Por favor, habilítalo en tu configuración de PHP.');
}

// Realizar una solicitud GET a la API usando cURL
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

// Verificar si ocurrió un error durante la solicitud
if (curl_errno($ch)) {
    echo 'Error en la solicitud cURL: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Verificar si la solicitud fue exitosa
if ($response !== false) {
    // Convertir la respuesta JSON a un array de PHP
    $data = json_decode($response, true);

    // Verificar si la conversión fue exitosa
    if (json_last_error() === JSON_ERROR_NONE) {
        // Mostrar la respuesta
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    } else {
        echo 'Error al decodificar la respuesta JSON: ' . json_last_error_msg();
    }
} else {
    echo 'Error al conectar con la API';
}
?>
