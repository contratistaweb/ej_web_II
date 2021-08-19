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

$item->nombre = $_GET['nombre'];
$item->precio = $_GET['precio'];
$item->existencia = $_GET['existencia'];

if ($item->createProducto()) { // return true
    echo 'Producto creado correctamente...';
} else { // return false
    echo 'Producto NO se creó ...';
}
?>