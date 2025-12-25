<?php
session_start(); 
include __DIR__ . '/../layout/header.php'; 
include __DIR__ . '/../../service/database.php';
$idUser = $_SESSION['id_user'];
// Logika Hapus History
if (isset($_GET['delete_history_id'])) {
    $idHapus = intval($_GET['delete_history_id']);
    // Pastikan hanya bisa hapus history miliknya sendiri dengan join ke tabel scrap
    $queryDelete = "DELETE h FROM history h 
                    JOIN scrap s ON h.id_scraps = s.id_scrap 
                    WHERE h.id_history = $idHapus AND s.id_user = $idUser";
    
    if (mysqli_query($db, $queryDelete)) {
        echo "<script>alert('Riwayat dihapus!'); window.location.href='history.php';</script>";
        exit;
    }
}

$query = "SELECT h.*, s.nama, s.link 
          FROM history h 
          INNER JOIN scrap s ON h.id_scraps = s.id_scrap 
          WHERE s.id_user = $idUser 
          ORDER BY h.checked_at DESC";
$result_history = mysqli_query($db, $query);
?>

<div class="d-flex min-vh-100">
    <?php include __DIR__ . '/../layout/sidebar.php'; ?>

    <div class="flex-grow-1 p-4 bg-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark mb-0">Riwayat Perubahan Harga</h2>
                <span class="badge bg-secondary px-3 py-2">Total Riwayat: <?= mysqli_num_rows($result_history) ?></span>
            </div>

            <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="ps-4 py-3">Produk</th>
                        <th>Waktu Cek</th>
                        <th>Perubahan Harga & Diskon</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_history)) : ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark"><?= htmlspecialchars($row['nama']) ?></div>
                                    <i class="bi bi-link-45deg"></i> <?= $row['link'] ?>
                                </a>
                            </td>
                            <td class="text-muted small">
                                <?= date('d M Y', strtotime($row['checked_at'])) ?><br>
                                <span class="badge bg-light text-dark border-0 p-0"><?= date('H:i', strtotime($row['checked_at'])) ?> WIB</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <small class="text-muted d-block">Harga</small>
                                        <span class="text-danger text-decoration-line-through small">Rp <?= number_format($row['last_harga']) ?></span>
                                        <i class="bi bi-arrow-right mx-1"></i>
                                        <span class="text-success fw-bold">Rp <?= number_format($row['new_harga']) ?></span>
                                    </div>
                                    <div class="border-start ps-3">
                                        <small class="text-muted d-block">Diskon</small>
                                        <span class="badge bg-warning text-dark"><?= $row['last_diskon'] ?>% &rarr; <?= $row['new_diskon'] ?>%</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center pe-4">
                                <a href="history.php?delete_history_id=<?= $row['id_history'] ?>" 
                                   class="btn btn-outline-danger btn-sm rounded-pill"
                                   onclick="return confirm('Hapus riwayat ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                                <?php if (mysqli_num_rows($result_history) == 0) : ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            Belum ada riwayat perubahan data.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
