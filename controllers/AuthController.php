<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/User.php';

class AuthController {
    private $user;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->user = new User($db);
    }

    public function login() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->user->authenticate($username, $password)) {
                $_SESSION['user_id'] = $this->user->id;
                $_SESSION['username'] = $this->user->username;
                $_SESSION['role'] = $this->user->role;

                header("Location: index.php?c=Dashboard&a=index");
                exit();
            } else {
                $error = "Username atau password salah!";
            }
        }

        include __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_unset();
        session_destroy();

        header("Location: index.php?c=Auth&a=login");
        exit();
    }
}