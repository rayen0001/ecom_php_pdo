<?php
require_once 'config/config.php';
require_once 'controllers/UserController.php';

$userController = new UserController($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action']; // Extract action from the form data
        if ($action === 'loginUser') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $userController->loginUser($username, $password);
        } elseif ($action === 'registerUser') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $userController->registerUser($username, $email, $password);
        }
    }
} else {
    // Redirect to homepage or display it if needed
    $userController->HomePage();
}
?>
