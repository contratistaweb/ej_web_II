<?php
date_default_timezone_set('America/Bogota');
class Producto
{
    // dbconnection
    private $db;
    // Table
    private $db_table = "producto";
    // Columns
    public $id;
    public $nombre;
    public $precio;
    public $existencia;

    public $result;


    // Db 
    public function __construct($db)
    {
        $this->db = $db;
    }

    // GET ALL
    public function getProductos()
    {
        $sqlQuery = "SELECT id, nombre, precio, existencia FROM " . $this->db_table . "";
        $this->result = $this->db->query($sqlQuery);
        return $this->result;
    }

    // CREATE
    public function createProducto()
    {
        // sanitize
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->existencia = htmlspecialchars(strip_tags($this->existencia));

        $sqlQuery = "INSERT INTO " . $this->db_table . " (nombre, precio, existencia) VALUES('$this->nombre','$this->precio','$this->existencia')";
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // GET ID
    public function getSingleProducto()
    {
        $sqlQuery = "SELECT id, nombre, precio, existencia FROM
" . $this->db_table . " WHERE id = " . $this->id;
        $record = $this->db->query($sqlQuery);
        $dataRow = $record->fetch_assoc();
        $this->nombre = $dataRow['nombre'];
        $this->precio = $dataRow['precio'];
        $this->existencia = $dataRow['existencia'];
    }

    // UPDATE
    public function updateProducto()
    {
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->existencia = htmlspecialchars(strip_tags($this->existencia));

        $sqlQuery = "UPDATE " . $this->db_table . " SET nombre = '" . $this->nombre . "',
precio = '" . $this->precio . "',
existencia = '" . $this->existencia . "'
WHERE id = " . $this->id;

        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // DELETE
    function deleteProducto()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = " . $this->id;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }
}
?>
