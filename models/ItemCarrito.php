<?php
class ItemCarrito {
    private $conn;
    private $table = 'itemcarrito';

    public $id;
    public $carrito_id;
    public $producto_id;
    public $cantidad;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear un item en el carrito
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (carrito_id, producto_id, cantidad) VALUES (:carrito_id, :producto_id, :cantidad)';
        
        $stmt = $this->conn->prepare($query);
        
        $this->carrito_id = htmlspecialchars(strip_tags($this->carrito_id));
        $this->producto_id = htmlspecialchars(strip_tags($this->producto_id));
        $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        
        $stmt->bindParam(':carrito_id', $this->carrito_id);
        $stmt->bindParam(':producto_id', $this->producto_id);
        $stmt->bindParam(':cantidad', $this->cantidad);
        
        if($stmt->execute()) {
            return true;
        }
        
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Método para leer todos los items del carrito
    public function read() {
        $query = 'SELECT 
                    i.id, 
                    i.carrito_id, 
                    i.producto_id, 
                    i.cantidad, 
                    p.nom_producto, 
                    p.precio 
                  FROM ' . $this->table . ' i
                  LEFT JOIN producto p ON i.producto_id = p.id_prod';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para eliminar un item del carrito
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Método para vaciar el carrito
    public function emptyCart() {
        $query = 'DELETE FROM ' . $this->table;
        
        $stmt = $this->conn->prepare($query);
        
        if($stmt->execute()) {
            return true;
        }
        
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Método para actualizar la cantidad de un item en el carrito
    public function updateQuantity() {
        $query = 'UPDATE ' . $this->table . ' SET cantidad = :cantidad WHERE id = :id';
        
        $stmt = $this->conn->prepare($query);
        
        $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':cantidad', $this->cantidad);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
?>
