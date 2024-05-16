<?php
require_once 'config/config.php';
class User {
    private $pdo;
    private $user_id;
    private $username;
    private $email;
    private $password_hash;
    private $created_at;
    private $type;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createUser($username, $email, $password, $type) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password_hash, type) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password_hash, $type]);
        $this->user_id = $this->pdo->lastInsertId();
        $this->username = $username;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->created_at = date('Y-m-d H:i:s');
        $this->type = $type;
    }

    public function loadUserById($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $this->user_id = $user['user_id'];
            $this->username = $user['username'];
            $this->email = $user['email'];
            $this->password_hash = $user['password_hash'];
            $this->created_at = $user['created_at'];
            $this->type = $user['type'];
        }
    }

    public function updateUser($username, $email) {
        $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ? WHERE user_id = ?");
        $stmt->execute([$username, $email, $this->user_id]);
        if ($stmt->rowCount() > 0) {
            $this->username = $username;
            $this->email = $email;
        }
    }

    public function deleteUser() {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->execute([$this->user_id]);
        return $stmt->rowCount() > 0;
    }

    // Getters
    public function getUserId() {
        return $this->user_id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPasswordHash() {
        return $this->password_hash;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getType() {
        return $this->type;
    }

    public function usernameExists($username) {
        // Prepare SQL statement to check if the username exists
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        // Return true if username exists, false otherwise
        return $count > 0;
    }

    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
