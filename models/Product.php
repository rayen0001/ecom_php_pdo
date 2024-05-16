<?php

require_once 'config/config.php';

class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get all products
    public function getAllProducts() {
        try {
            $stmt = $this->pdo->query('SELECT * FROM products');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Get product by ID
    public function getProductById($product_id) {
        try {
            $query = "SELECT * FROM products WHERE product_id = :product_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(':product_id' => $product_id));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Add a new product
    public function addProduct($product_name, $price, $description, $image_url, $category_id) {
        try {
            $query = "INSERT INTO products (product_name, price, description, image_url, category_id) VALUES (:product_name, :price, :description, :image_url, :category_id)";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute(array(
                ':product_name' => $product_name,
                ':price' => $price,
                ':description' => $description,
                ':image_url' => $image_url,
                ':category_id' => $category_id
            ));
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Update an existing product
    public function updateProduct($product_id, $product_name, $price, $description, $image_url, $category_id) {
        try {
            $query = "UPDATE products SET product_name = :product_name, price = :price, description = :description, image_url = :image_url, category_id = :category_id WHERE product_id = :product_id";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute(array(
                ':product_id' => $product_id,
                ':product_name' => $product_name,
                ':price' => $price,
                ':description' => $description,
                ':image_url' => $image_url,
                ':category_id' => $category_id
            ));
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Delete a product
    public function deleteProduct($product_id) {
        try {
            $query = "DELETE FROM products WHERE product_id = :product_id";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute(array(':product_id' => $product_id));
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

?>
