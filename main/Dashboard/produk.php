<?php 
session_start();
include __DIR__ . '/../layout/header.php'; 
include __DIR__ . '/../../service/database.php';


$idUser = $_SESSION['id_user'];

$query = "SELECT * FROM scrap WHERE id_user = $idUser";
$result = mysqli_query($db, $query);

if (!isset($_SESSION['id_user'])) {
    header("Location: /main/login.php");
    exit;
}


?>

<div class="d-flex min-vh-100">
    <?php include __DIR__ . '/../layout/sidebar.php'; ?>

    <div class="flex-grow-1 p-4 bg-light">
        <div class="container-fluid">
            <h2 class="mb-4 fw-bold text-dark text-center text-md-start">Dashboard Produk</h2>
            
            <div class="row g-4">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                            <div class="card-body d-flex flex-column p-4">
                                <div class="mb-2">
                                    <span class="badge bg-danger rounded-pill px-3">
                                        Diskon <?= $row['diskon'] ?>%
                                    </span>
                                </div>

                                <h5 class="card-title fw-bold text-dark text-truncate mb-1" title="<?= htmlspecialchars($row['nama']) ?>">
                                    <?= htmlspecialchars($row['nama']) ?>
                                </h5>

                                <p class="card-text mb-4">
                                    <small class="text-muted d-block">Harga:</small>
                                    <span class="fs-5 fw-bold text-primary">
                                        Rp <?= number_format($row['harga'], 0, ',', '.') ?>
                                    </span>
                                </p>

                                <div class="mt-auto d-grid gap-2">
                                    <a href="<?= preg_match('~^https?://~i', $row['link']) ? $row['link'] : 'https://' . $row['link'] ?>" 
                                       target="_blank" 
                                       rel="noopener noreferrer" 
                                       class="btn btn-primary btn-sm rounded-2 shadow-sm">
                                       <i class="bi bi-eye me-1"></i> Lihat Produk
                                    </a>

                                    <a href="/fitur/produkdelete.php?id=<?= $row['id_scrap'] ?>" 
                                       class="btn btn-outline-danger btn-sm rounded-2"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                       <i class="bi bi-trash me-1"></i> Hapus Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php if (mysqli_num_rows($result) == 0) : ?>
                <div class="alert alert-info mt-3 text-center shadow-sm">
                    Belum ada data produk yang di simpan.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
