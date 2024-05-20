<?php
class Trabajador {
    private $conn;
    private $table_name = "TRABAJADOR";

    public $id_trab;
    public $nom_trab;
    public $apaterno_trab;
    public $amaterno_trab;
    public $rut_trab;
    public $dv_trab;
    public $mail_trab;
    public $pass_trab;
    public $id_sucursal;
    public $id_cargo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function fetchAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function fetchById($id_trab) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_TRAB = :id_trab";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_trab', $id_trab);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET NOM_TRAB = :nom_trab, APATERNO_TRAB = :apaterno_trab, AMATERNO_TRAB = :amaterno_trab, RUT_TRAB = :rut_trab, DV_TRAB = :dv_trab, MAIL_TRAB = :mail_trab, PASS_TRAB = :pass_trab, ID_SUCURSAL = :id_sucursal, ID_CARGO = :id_cargo";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom_trab', $this->nom_trab);
        $stmt->bindParam(':apaterno_trab', $this->apaterno_trab);
        $stmt->bindParam(':amaterno_trab', $this->amaterno_trab);
        $stmt->bindParam(':rut_trab', $this->rut_trab);
        $stmt->bindParam(':dv_trab', $this->dv_trab);
        $stmt->bindParam(':mail_trab', $this->mail_trab);
        $stmt->bindParam(':pass_trab', $this->pass_trab);
        $stmt->bindParam(':id_sucursal', $this->id_sucursal);
        $stmt->bindParam(':id_cargo', $this->id_cargo);

        return $stmt->execute();
    }

    public function update($id_trab) {
        $query = "UPDATE " . $this->table_name . " SET NOM_TRAB = :nom_trab, APATERNO_TRAB = :apaterno_trab, AMATERNO_TRAB = :amaterno_trab, RUT_TRAB = :rut_trab, DV_TRAB = :dv_trab, MAIL_TRAB = :mail_trab, PASS_TRAB = :pass_trab, ID_SUCURSAL = :id_sucursal, ID_CARGO = :id_cargo WHERE ID_TRAB = :id_trab";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom_trab', $this->nom_trab);
        $stmt->bindParam(':apaterno_trab', $this->apaterno_trab);
        $stmt->bindParam(':amaterno_trab', $this->amaterno_trab);
        $stmt->bindParam(':rut_trab', $this->rut_trab);
        $stmt->bindParam(':dv_trab', $this->dv_trab);
        $stmt->bindParam(':mail_trab', $this->mail_trab);
        $stmt->bindParam(':pass_trab', $this->pass_trab);
        $stmt->bindParam(':id_sucursal', $this->id_sucursal);
        $stmt->bindParam(':id_cargo', $this->id_cargo);
        $stmt->bindParam(':id_trab', $id_trab);

        return $stmt->execute();
    }

    public function delete($id_trab) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_TRAB = :id_trab";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_trab', $id_trab);
        return $stmt->execute();
    }
}
?>
