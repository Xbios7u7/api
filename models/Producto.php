<?php
class Producto {
    // DB stuff
    private $conn;
    private $table = 'producto';

    // Properties
    public $id_prod;
    public $sku;
    public $nom_producto;
    public $modelo;
    public $descripcion;
    public $precio;
    public $stock;
    public $id_categoria;
    public $id_marca;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Create Product
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' 
                  (sku, nom_producto, modelo, descripcion, precio, stock, id_categoria, id_marca) 
                  VALUES (:sku, :nom_producto, :modelo, :descripcion, :precio, :stock, :id_categoria, :id_marca)';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->nom_producto = htmlspecialchars(strip_tags($this->nom_producto));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->id_categoria = htmlspecialchars(strip_tags($this->id_categoria));
        $this->id_marca = htmlspecialchars(strip_tags($this->id_marca));

        // Bind data
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':nom_producto', $this->nom_producto);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':id_categoria', $this->id_categoria);
        $stmt->bindParam(':id_marca', $this->id_marca);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Fetch product by ID
    public function fetchByID($id_prod) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id_prod = :id_prod';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_prod', $id_prod);
        $stmt->execute();
        return $stmt;
    }

    // Fetch all products
    public function fetchAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read single product
    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id_prod = :id_prod LIMIT 0,1';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_prod', $this->id_prod);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->sku = $row['sku'];
        $this->nom_producto = $row['nom_producto'];
        $this->modelo = $row['modelo'];
        $this->descripcion = $row['descripcion'];
        $this->precio = $row['precio'];
        $this->stock = $row['stock'];
        $this->id_categoria = $row['id_categoria'];
        $this->id_marca = $row['id_marca'];
    }
}
?>
