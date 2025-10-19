<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$title = isset($data) ? "Edit Karyawan" : "Tambah Karyawan";

$divisionsFile = __DIR__ . '/../../config/division.json';
$divisions = file_exists($divisionsFile)
    ? json_decode(file_get_contents($divisionsFile), true)
    : [];

ob_start();
?>

<div class="main-container">
    <div class="content content-form">
        <h4 class="form-title text-center mb-3"><?= htmlspecialchars($title) ?></h4>
        <hr class="form-divider mb-4">

        <form method="POST" class="form-layout mx-auto">
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama</label>
                <input type="text" name="name" class="form-control form-input"
                    value="<?= isset($data) ? htmlspecialchars($data['name']) : '' ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Divisi</label>
                <select name="division" class="form-select form-input" required>
                    <option value="">-- Pilih Divisi --</option>
                    <?php foreach ($divisions as $division): ?>
                        <option value="<?= htmlspecialchars($division) ?>"
                            <?= isset($data) && $data['division'] === $division ? 'selected' : '' ?>>
                            <?= htmlspecialchars($division) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nomor Telepon</label>
                <input type="text" name="phone" class="form-control form-input"
                    value="<?= isset($data) ? htmlspecialchars($data['phone']) : '' ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Alamat</label>
                <textarea name="address" class="form-control form-input fixed-textarea" rows="3" required><?= isset($data) ? htmlspecialchars($data['address']) : '' ?></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-blue px-5">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/dashboard.php';
?>
