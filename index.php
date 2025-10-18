<?php
session_start();

// Routing sederhana
$c = $_GET['c'] ?? 'Auth';
$a = $_GET['a'] ?? 'login';

// Jika user sudah login, arahkan ke halaman utama
if (isset($_SESSION['user_id']) && $c === 'Auth' && $a === 'login') {
    header('Location: index.php?c=Employee&a=index');
    exit;
}

// Jika user belum login dan mencoba akses selain Auth/login, arahkan ke login
if (!isset($_SESSION['user_id']) && !($c === 'Auth' && in_array($a, ['login', 'doLogin']))) {
    header('Location: index.php?c=Auth&a=login');
    exit;
}

// Cek apakah controller ada
$controllerFile = "controllers/" . $c . "Controller.php";
if (!file_exists($controllerFile)) {
    die("Controller tidak ditemukan: " . htmlspecialchars($c));
}

include $controllerFile;

// Instansiasi controller
$className = $c . "Controller";
$controller = new $className();

// Cek apakah method ada
if (!method_exists($controller, $a)) {
    die("Method tidak ditemukan: " . htmlspecialchars($a));
}

// Jika membutuhkan ID
$id = $_GET['id'] ?? null;

// Jalankan method
if ($id !== null) {
    $controller->$a($id);
} else {
    $controller->$a();
}
?>
