<?php
require_once 'models/User.php'; // Include User model class
require_once 'models/Product.php'; // Include Product model class
require_once __DIR__ . '/../config/config.php'; // Include configuration file

class UserController {
    private $userModel;
    private $productModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo); // Initialize User model object
        $this->productModel = new Product($pdo); // Initialize Product model object
    }

    public function registerUser($username, $email, $password) {
        // Set the type to "client"
        $type = 'client';
    
        // Check if the username already exists
        if ($this->userModel->usernameExists($username)) {
            header("Location: http://localhost/index.php?error=username_exists");
            exit();
        }
    
        // If username is unique, proceed with registration
        $this->userModel->createUser($username, $email, $password, $type);
        header("Location: http://localhost/index.php?registration=success");
        exit();
    }
    
    public function loginUser($username, $password) {
        // Validate input (you may add more validation as needed)
        if (empty($username) || empty($password)) {
            // Show error message or redirect back to login page with error
            header("Location: http://localhost/userController.php?action=HomePage");
            exit();
        }
    
        // Check if the username exists in the database
        $user = $this->userModel->getUserByUsername($username);
        if (!$user) {
            // Show error message or redirect back to login page with error
            header("Location: http://localhost/userController.php?action=HomePage&error=user_not_found");
            exit();
        }
    
        // Verify the password
        $passwordHash = $user['password_hash']; // Assuming 'password' is the column name for hashed passwords
        if (!password_verify($password, $passwordHash)) {
            // Show error message or redirect back to login page with error
            header("Location: http://localhost/userController.php?action=HomePage&error=incorrect_password");
            exit();
        }
    
        // Login successful: Set session or cookie to indicate user is logged in
        session_start();
        // $_SESSION['user_id'] = $user['id']; // Store user ID or other relevant info in session
        self::Shopping(); // Redirect to shopping page
        exit();
    }
    
    // Show list of users
    public function showUserList() {
        $users = $this->userModel->getAllUsers(); // Get all users from database
    }
    
    // Update user information
    public function updateUser($user_id, $username, $email) {
        // Validate inputs
        $updated = $this->userModel->updateUser($user_id, $username, $email); // Update user in database
        if ($updated) {
            // Redirect or show success message
        } else {
            // Redirect or show error message
        }
    }
    
    // Delete user
    public function deleteUser($user_id) {
        // Delete user by ID
        $deleted = $this->userModel->deleteUser($user_id); // Delete user from database
        if ($deleted) {
            // Redirect or show success message
        } else {
            // Redirect or show error message
        }
    }
    
    // Logout user
    public function logoutUser() {
        // Logout logic (destroy session, clear cookies, etc.)
        // Redirect to login page or homepage
    }
    
    // Static method to render homepage
    public static function HomePage() {
        require_once 'views/Home.php'; // Include Home view file
    }
    
    // Static method to render shopping page
    public static function Shopping() {
        require_once 'views/shopping_page.php'; // Include shopping_page view file
        
        // Initialize PDO connection using PostgreSQL
        $dsn = 'pgsql:host=localhost;dbname=ecommerce_db';
        $username = 'postgres';
        $password = 'root';
        
        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Initialize Product model object
            $productModel = new Product($pdo);
            
            // Fetch all products
            $products = $productModel->getAllProducts();
            
            // Pass products to the view
            require_once 'views/shopping_page.php';
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    
}
?>
