<?php
class Cargo {
    private $conn;
    private $table_name = "CARGO";

    public $id_cargo;
    public $nom_cargo;
    public $descripcion_cargo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function fetchAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function fetchById($id_cargo) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_CARGO = :id_cargo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cargo', $id_cargo);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET NOM_CARGO = :nom_cargo, DESCRIPCION_CARGO = :descripcion_cargo";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom_cargo', $this->nom_cargo);
        $stmt->bindParam(':descripcion_cargo', $this->descripcion_cargo);

        return $stmt->execute();
    }

    public function update($id_cargo) {
        $query = "UPDATE " . $this->table_name . " SET NOM_CARGO = :nom_cargo, DESCRIPCION_CARGO = :descripcion_cargo WHERE ID_CARGO = :id_cargo";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom_cargo', $this->nom_cargo);
        $stmt->bindParam(':descripcion_cargo', $this->descripcion_cargo);
        $stmt->bindParam(':id_cargo', $id_cargo);

        return $stmt->execute();
    }

    public function delete($id_cargo) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_CARGO = :id_cargo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cargo', $id_cargo);
        return $stmt->execute();
    }
}
?>
