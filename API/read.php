<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../database.php';
include_once '../producto.php';
$database = new Database();

$db = $database->getConnection();
$items = new Producto($db);
$records = $items->getProductos();
$itemCount = $records->num_rows;
if ($itemCount > 0) {
    $productoArr = array();
    while ($row = $records->fetch_assoc()) {
        array_push($productoArr, $row);
    }
    echo json_encode($productoArr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Productos NO encontrados...")
    );
}
?>