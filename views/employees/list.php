<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$title = "Daftar Karyawan";
ob_start();
?>

<div class="main-container">
    <div class="content">
        <h2>Daftar Karyawan</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($stmt): ?>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['division']) ?></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td>
                                <a href="index.php?c=Employee&a=detail&id=<?= $row['id'] ?>" class="btn btn-blue btn-sm">Detail</a>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                    <a href="index.php?c=Employee&a=edit&id=<?= $row['id'] ?>" class="btn btn-yellow btn-sm">Edit</a>
                                    <a href="index.php?c=Employee&a=delete&id=<?= $row['id'] ?>" class="btn btn-red btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/dashboard.php';
?>
