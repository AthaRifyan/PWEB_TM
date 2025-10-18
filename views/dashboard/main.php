<div class="content">
    <h2>Selamat Datang di Aplikasi Manajemen Karyawan</h2>
    <p>Anda login sebagai <strong><?= htmlspecialchars($_SESSION['role'] ?? 'user') ?></strong>.</p>

    <div class="card mt-4">
        <div class="card-body">
            <h4>Total Karyawan</h4>
            <div class="display-5 text-primary"><?= htmlspecialchars($totalEmployees ?? 0) ?></div>
        </div>
    </div>
</div>
