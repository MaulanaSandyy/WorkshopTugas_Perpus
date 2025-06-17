<?php
require_once '../config/database.php';
check_login(['admin']);

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "DELETE FROM buku WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['pesan'] = "Buku berhasil dihapus.";
    } else {
        $_SESSION['pesan'] = "Gagal menghapus buku. Mungkin buku sedang dipinjam.";
    }
}
header("Location: " . $main_url . "buku/index.php");
exit();
?>
