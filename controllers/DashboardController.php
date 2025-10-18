<?php
require_once 'config/Database.php';
require_once 'models/Employee.php';

class DashboardController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?c=Auth&a=login');
            exit;
        }

        $database = new Database();
        $db = $database->getConnection();
        $employee = new Employee($db);
        $totalEmployees = $employee->count();

        $title = "Dashboard";
        $content = "views/dashboard/main.php";

        include "views/layout/dashboard.php";
    }
}
?>
