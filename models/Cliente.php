<?php
class Cliente {
    private $conn;
    private $table_name = "CLIENTE";

    public $id_cli;
    public $nom_cli;
    public $apaterno_cli;
    public $amaterno_cli;
    public $rut_cli;
    public $dv_cli;
    public $mail_cli;
    public $pass_cli;
    public $numero_cli;
    public $direccion_cli;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function fetchAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function fetchById($id_cli) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_CLI = :id_cli";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cli', $id_cli);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET NOM_CLI = :nom_cli, APATERNO_CLI = :apaterno_cli, AMATERNO_CLI = :amaterno_cli, RUT_CLI = :rut_cli, DV_CLI = :dv_cli, MAIL_CLI = :mail_cli, PASS_CLI = :pass_cli, NUMERO_CLI = :numero_cli, DIRECCION_CLI = :direccion_cli";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom_cli', $this->nom_cli);
        $stmt->bindParam(':apaterno_cli', $this->apaterno_cli);
        $stmt->bindParam(':amaterno_cli', $this->amaterno_cli);
        $stmt->bindParam(':rut_cli', $this->rut_cli);
        $stmt->bindParam(':dv_cli', $this->dv_cli);
        $stmt->bindParam(':mail_cli', $this->mail_cli);
        $stmt->bindParam(':pass_cli', $this->pass_cli);
        $stmt->bindParam(':numero_cli', $this->numero_cli);
        $stmt->bindParam(':direccion_cli', $this->direccion_cli);

        return $stmt->execute();
    }

    public function update($id_cli) {
        $query = "UPDATE " . $this->table_name . " SET NOM_CLI = :nom_cli, APATERNO_CLI = :apaterno_cli, AMATERNO_CLI = :amaterno_cli, RUT_CLI = :rut_cli, DV_CLI = :dv_cli, MAIL_CLI = :mail_cli, PASS_CLI = :pass_cli, NUMERO_CLI = :numero_cli, DIRECCION_CLI = :direccion_cli WHERE ID_CLI = :id_cli";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom_cli', $this->nom_cli);
        $stmt->bindParam(':apaterno_cli', $this->apaterno_cli);
        $stmt->bindParam(':amaterno_cli', $this->amaterno_cli);
        $stmt->bindParam(':rut_cli', $this->rut_cli);
        $stmt->bindParam(':dv_cli', $this->dv_cli);
        $stmt->bindParam(':mail_cli', $this->mail_cli);
        $stmt->bindParam(':pass_cli', $this->pass_cli);
        $stmt->bindParam(':numero_cli', $this->numero_cli);
        $stmt->bindParam(':direccion_cli', $id_cli);

        return $stmt->execute();
    }

    public function delete($id_cli) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_CLI = :id_cli";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cli', $id_cli);
        return $stmt->execute();
    }
}
?>
