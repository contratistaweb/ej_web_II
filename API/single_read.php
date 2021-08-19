<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database.php';
include_once '../producto.php';
$database = new Database();
$db = $database->getConnection();
$item = new Producto($db);
$item->id = isset($_GET['id']) ? $_GET['id'] : die();
$item->getSingleProducto();
if ($item->nombre != null) {

    // create array
    $producto_arr = array(
        "id" => $item->id,
        "nombre" => $item->nombre,
        "precio" => $item->precio,
        "existencia" => $item->existencia
    );

    http_response_code(200);
    echo json_encode($producto_arr);
} else {
    http_response_code(404);
    echo json_encode("Producto NO encontrado.");
}
?>