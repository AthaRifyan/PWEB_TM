<?php
class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $username;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function authenticate($username, $password) {
        try {
            $query = "SELECT id, username, password, role FROM {$this->table} WHERE username = :username LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                return false;
            }

            if (password_verify($password, $row['password']) || $password === $row['password']) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->role = $row['role'];
                return true;
            }

            return false;
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }
}
?>
