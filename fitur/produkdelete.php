<?php
session_start();
include __DIR__ . '/../service/database.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = mysqli_prepare($db, "DELETE FROM scrap WHERE id_scrap = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>
            alert('Produk berhasil dihapus!');
            window.location.href = '/main/Dashboard/produk.php';
        </script>";
    } else {
        echo "Gagal menghapus: " . mysqli_error($db);
    }
}
?>