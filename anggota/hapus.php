<?php
require_once '../config/database.php';
check_login(['admin']);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Pastikan tidak menghapus user admin
    $stmt_check = mysqli_prepare($koneksi, "SELECT role FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt_check, "i", $id);
    mysqli_stmt_execute($stmt_check);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_check));

    if ($user && $user['role'] === 'anggota') {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Menghapus user akan otomatis menghapus peminjaman terkait karena ON DELETE CASCADE
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['pesan'] = "Anggota berhasil dihapus.";
        } else {
            $_SESSION['pesan'] = "Gagal menghapus anggota.";
        }
    } else {
        $_SESSION['pesan'] = "Operasi tidak diizinkan atau pengguna tidak ditemukan.";
    }
} else {
    $_SESSION['pesan'] = "ID Anggota tidak valid.";
}

header("Location: " . $main_url . "anggota/index.php");
exit();
?>
