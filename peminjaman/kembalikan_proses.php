<?php
require_once '../config/database.php';
check_login();

$id_peminjaman = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$id_user = $_SESSION['user_id'];
$tanggal_kembali = date('Y-m-d');
$redirect_url = $main_url . 'peminjaman/riwayat.php';

mysqli_begin_transaction($koneksi);
try {
    $stmt_get = mysqli_prepare($koneksi, "SELECT id_buku FROM peminjaman WHERE id = ? AND id_user = ? AND status = 'dipinjam' FOR UPDATE");
    mysqli_stmt_bind_param($stmt_get, "ii", $id_peminjaman, $id_user);
    mysqli_stmt_execute($stmt_get);
    $peminjaman = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_get));

    if ($peminjaman) {
        $id_buku = $peminjaman['id_buku'];
        
        $stmt_update_pinjam = mysqli_prepare($koneksi, "UPDATE peminjaman SET status = 'kembali', tanggal_kembali = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt_update_pinjam, "si", $tanggal_kembali, $id_peminjaman);
        mysqli_stmt_execute($stmt_update_pinjam);
        
        $stmt_update_stok = mysqli_prepare($koneksi, "UPDATE buku SET stok = stok + 1 WHERE id = ?");
        mysqli_stmt_bind_param($stmt_update_stok, "i", $id_buku);
        mysqli_stmt_execute($stmt_update_stok);

        mysqli_commit($koneksi);
        $_SESSION['pesan'] = "Buku berhasil dikembalikan.";
    } else {
        mysqli_rollback($koneksi);
        $_SESSION['pesan'] = "Gagal mengembalikan buku. Data peminjaman tidak valid atau bukan milik Anda.";
    }
} catch (mysqli_sql_exception $e) {
    mysqli_rollback($koneksi);
    $_SESSION['pesan'] = "Terjadi kesalahan database: " . $e->getMessage();
}

header('Location: ' . $redirect_url);
exit;
?>
