<?php
require_once '../config/database.php';
check_login();

// Mengambil data dari form dengan metode POST
$id_buku = isset($_POST['id_buku']) ? (int)$_POST['id_buku'] : 0;
$tanggal_jatuh_tempo = isset($_POST['tanggal_jatuh_tempo']) ? $_POST['tanggal_jatuh_tempo'] : '';
$id_user = $_SESSION['user_id'];
$tanggal_pinjam = date('Y-m-d');
$redirect_fail = $main_url . 'buku/index.php';

// Validasi input
if ($id_buku == 0) {
    $_SESSION['pesan'] = "Error: ID Buku tidak valid.";
    header('Location: ' . $redirect_fail);
    exit;
}

if (empty($tanggal_jatuh_tempo) || new DateTime($tanggal_jatuh_tempo) < new DateTime($tanggal_pinjam)) {
    $_SESSION['pesan'] = "Error: Tanggal pengembalian tidak valid.";
    header('Location: ' . $redirect_fail);
    exit;
}


// Mulai transaksi database
mysqli_begin_transaction($koneksi);
try {
    // Cek stok buku
    $stmt_cek = mysqli_prepare($koneksi, "SELECT stok FROM buku WHERE id = ? FOR UPDATE");
    mysqli_stmt_bind_param($stmt_cek, "i", $id_buku);
    mysqli_stmt_execute($stmt_cek);
    $buku = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_cek));

    if ($buku && $buku['stok'] > 0) {
        // Kurangi stok
        $stmt_update = mysqli_prepare($koneksi, "UPDATE buku SET stok = stok - 1 WHERE id = ?");
        mysqli_stmt_bind_param($stmt_update, "i", $id_buku);
        mysqli_stmt_execute($stmt_update);
        
        // Buat record peminjaman baru dengan tanggal jatuh tempo dari user
        $status = 'dipinjam';
        $stmt_pinjam = mysqli_prepare($koneksi, "INSERT INTO peminjaman (id_buku, id_user, tanggal_pinjam, tanggal_jatuh_tempo, status) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt_pinjam, "iisss", $id_buku, $id_user, $tanggal_pinjam, $tanggal_jatuh_tempo, $status);
        mysqli_stmt_execute($stmt_pinjam);

        // Jika semua query berhasil, simpan perubahan
        mysqli_commit($koneksi);
        $_SESSION['pesan'] = "Buku berhasil dipinjam. Mohon kembalikan sebelum tanggal " . date('d F Y', strtotime($tanggal_jatuh_tempo)) . ".";
        header('Location: ' . $main_url . 'peminjaman/riwayat.php');

    } else {
        // Jika stok habis, batalkan semua perubahan
        mysqli_rollback($koneksi);
        $_SESSION['pesan'] = "Gagal meminjam buku. Stok mungkin sudah habis.";
        header('Location: ' . $redirect_fail);
    }
} catch (mysqli_sql_exception $e) {
    mysqli_rollback($koneksi);
    $_SESSION['pesan'] = "Terjadi kesalahan pada database: " . $e->getMessage();
    header('Location: ' . $redirect_fail);
}
exit;
?>
