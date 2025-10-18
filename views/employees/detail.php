<?php
$title = "Detail Karyawan";
include __DIR__ . '/../layout/dashboard.php';
startblock();
?>

<div class="main-container">
    <div class="content">
        <h2>Detail Karyawan</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>Nama:</strong> <?= htmlspecialchars($data['name']) ?></p>
                <p><strong>Divisi:</strong> <?= htmlspecialchars($data['division']) ?></p>
                <p><strong>Nomor Telepon:</strong> <?= htmlspecialchars($data['phone']) ?></p>
                <p><strong>Alamat:</strong> <?= htmlspecialchars($data['address']) ?></p>
                <p><strong>Dibuat:</strong> <?= htmlspecialchars($data['created_at']) ?></p>
            </div>
        </div>

        <a href="index.php?c=Employee&a=index" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>

<?php endblock(); ?>
