<?php
class Categoria {
    private $conn;
    private $table_name = "CATEGORIA";

    public $id_categoria;
    public $nom_categoria;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function fetchAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function fetchById($id_categoria) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_CATEGORIA = :id_categoria";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET NOM_CATEGORIA = :nom_categoria";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom_categoria', $this->nom_categoria);
        return $stmt->execute();
    }

    public function update($id_categoria) {
        $query = "UPDATE " . $this->table_name . " SET NOM_CATEGORIA = :nom_categoria WHERE ID_CATEGORIA = :id_categoria";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom_categoria', $this->nom_categoria);
        $stmt->bindParam(':id_categoria', $id_categoria);
        return $stmt->execute();
    }

    public function delete($id_categoria) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_CATEGORIA = :id_categoria";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_categoria', $id_categoria);
        return $stmt->execute();
    }
}
?>
