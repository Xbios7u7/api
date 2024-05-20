<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $db = "ferremas";
    private $pwd = "root";
    private $conn = null;

    public function connect() {
        if ($this->conn !== null) {
            return $this->conn;
        }

        try {
            $dsn = "mysql:host=$this->host;dbname=$this->db;charset=utf8";
            $this->conn = new PDO($dsn, $this->user, $this->pwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
            die();
        }

        return $this->conn;
    }
}

?>
