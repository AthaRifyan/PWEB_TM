<?php
session_start();

$c = $_GET['c'] ?? 'Auth';
$a = $_GET['a'] ?? 'login';

if (isset($_SESSION['user_id']) && $c === 'Auth' && $a === 'login') {
    header('Location: index.php?c=Employee&a=index');
    exit;
}

if (!isset($_SESSION['user_id']) && !($c === 'Auth' && in_array($a, ['login', 'doLogin']))) {
    header('Location: index.php?c=Auth&a=login');
    exit;
}

$controllerFile = "controllers/" . $c . "Controller.php";
if (!file_exists($controllerFile)) {
    die("Controller tidak ditemukan: " . htmlspecialchars($c));
}

include $controllerFile;

$className = $c . "Controller";
$controller = new $className();

if (!method_exists($controller, $a)) {
    die("Method tidak ditemukan: " . htmlspecialchars($a));
}

$id = $_GET['id'] ?? null;

if ($id !== null) {
    $controller->$a($id);
} else {
    $controller->$a();
}
?>