<?php
class Boleta {
    private $conn;
    private $table_name = "BOLETA";

    public $id_boleta;
    public $fecha_boleta;
    public $cantidad;
    public $total;
    public $id_trab;
    public $id_cli;
    public $id_prod;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function fetchAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function fetchById($id_boleta) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_BOLETA = :id_boleta";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_boleta', $id_boleta);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET FECHA_BOLETA = :fecha_boleta, CANTIDAD = :cantidad, TOTAL = :total, ID_TRAB = :id_trab, ID_CLI = :id_cli, ID_PROD = :id_prod";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':fecha_boleta', $this->fecha_boleta);
        $stmt->bindParam(':cantidad', $this->cantidad);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':id_trab', $this->id_trab);
        $stmt->bindParam(':id_cli', $this->id_cli);
        $stmt->bindParam(':id_prod', $this->id_prod);

        return $stmt->execute();
    }

    public function update($id_boleta) {
        $query = "UPDATE " . $this->table_name . " SET FECHA_BOLETA = :fecha_boleta, CANTIDAD = :cantidad, TOTAL = :total, ID_TRAB = :id_trab, ID_CLI = :id_cli, ID_PROD = :id_prod WHERE ID_BOLETA = :id_boleta";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':fecha_boleta', $this->fecha_boleta);
        $stmt->bindParam(':cantidad', $this->cantidad);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':id_trab', $this->id_trab);
        $stmt->bindParam(':id_cli', $this->id_cli);
        $stmt->bindParam(':id_prod', $this->id_prod);
        $stmt->bindParam(':id_boleta', $id_boleta);

        return $stmt->execute();
    }

    public function delete($id_boleta) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_BOLETA = :id_boleta";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_boleta', $id_boleta);
        return $stmt->execute();
    }
}
?>
