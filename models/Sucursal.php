<?php
class Sucursal {
    private $conn;
    private $table_name = "SUCURSAL";

    public $id_sucursal;
    public $nom_sucursal;
    public $direccion_sucursal;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function fetchAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function fetchById($id_sucursal) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_SUCURSAL = :id_sucursal";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sucursal', $id_sucursal);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET NOM_SUCURSAL = :nom_sucursal, DIRECCION_SUCURSAL = :direccion_sucursal";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom_sucursal', $this->nom_sucursal);
        $stmt->bindParam(':direccion_sucursal', $this->direccion_sucursal);

        return $stmt->execute();
    }

    public function update($id_sucursal) {
        $query = "UPDATE " . $this->table_name . " SET NOM_SUCURSAL = :nom_sucursal, DIRECCION_SUCURSAL = :direccion_sucursal WHERE ID_SUCURSAL = :id_sucursal";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom_sucursal', $this->nom_sucursal);
        $stmt->bindParam(':direccion_sucursal', $this->direccion_sucursal);
        $stmt->bindParam(':id_sucursal', $id_sucursal);

        return $stmt->execute();
    }

    public function delete($id_sucursal) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_SUCURSAL = :id_sucursal";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sucursal', $id_sucursal);
        return $stmt->execute();
    }
}
?>
