<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Dashboard') ?></title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
<div class="layout-body">
    <aside class="sidebar">
        <h5>Manajemen Karyawan</h5>
        <a href="index.php?c=Dashboard&a=index"
            class="<?= (($_GET['c'] ?? '') === 'Dashboard') ? 'active' : '' ?>">Dashboard</a>
        <a href="index.php?c=Employee&a=index"
            class="<?= (($_GET['c'] ?? '') === 'Employee' && ($_GET['a'] ?? '') === 'index') ? 'active' : '' ?>">Daftar Karyawan</a>
        <a href="index.php?c=Employee&a=create"
            class="<?= (($_GET['c'] ?? '') === 'Employee' && ($_GET['a'] ?? '') === 'create') ? 'active' : '' ?>">Tambah Karyawan</a>
        <div style="margin-top:auto; padding:15px;">
            <a href="index.php?c=Auth&a=logout" class="logout-btn">Logout</a>
        </div>
    </aside>
    <div class="main-content">
        <header class="header">
            <h3><?= htmlspecialchars($title ?? "Dashboard") ?></h3>
        </header>
        <main class="main-container">
            <?php
            if (!empty($content)) {
                if (is_string($content) && file_exists($content)) {
                    include $content;
                } else {
                    echo $content;
                }
            } else {
                echo "<p style='color:#c00;'>Konten tidak ditemukan.</p>";
            }
            ?>
        </main>
    </div>
</div>
</body>
</html>