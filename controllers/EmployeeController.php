<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Employee.php';

class EmployeeController {
    private $employee;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->employee = new Employee($db);
    }

    public function index() {
        $stmt = $this->employee->getAll();
        include __DIR__ . '/../views/employees/list.php';
    }

    public function detail($id) {
        $data = $this->employee->getById($id);
        if (!$data) {
            die("Data tidak ditemukan.");
        }
        include __DIR__ . '/../views/employees/detail.php';
    }

    public function create() {
        if ($_POST) {
            $this->employee->name = $_POST['name'];
            $this->employee->division = $_POST['division'];
            $this->employee->phone = $_POST['phone'];
            $this->employee->address = $_POST['address'];

            if ($this->employee->create()) {
                header("Location: index.php?c=Employee&a=index");
                exit();
            } else {
                $error = "Gagal menambahkan data.";
            }
        }
        include __DIR__ . '/../views/employees/form.php';
    }

    public function edit($id) {
        if ($_POST) {
            $this->employee->id = $id;
            $this->employee->name = $_POST['name'];
            $this->employee->division = $_POST['division'];
            $this->employee->phone = $_POST['phone'];
            $this->employee->address = $_POST['address'];

            if ($this->employee->update()) {
                header("Location: index.php?c=Employee&a=index");
                exit();
            } else {
                $error = "Gagal mengubah data.";
            }
        } else {
            $data = $this->employee->getById($id);
            if (!$data) {
                die("Data tidak ditemukan.");
            }
        }
        include __DIR__ . '/../views/employees/form.php';
    }

    public function delete($id) {
        $this->employee->id = $id;
        if ($this->employee->delete()) {
            header("Location: index.php?c=Employee&a=index");
            exit();
        } else {
            die("Gagal menghapus data.");
        }
    }
}