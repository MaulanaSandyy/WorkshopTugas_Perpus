<?php
session_start();
require_once '../../../config/database.php';
require_once '../../../functions/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../../../auth/login.php');
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Cek apakah anggota memiliki peminjaman yang belum dikembalikan
$hasBorrowed = query("SELECT COUNT(*) as total FROM peminjaman WHERE anggota_id = $id AND status = 'dipinjam'")->fetch_assoc()['total'];

if ($hasBorrowed > 0) {
    $_SESSION['error'] = 'Anggota tidak dapat dihapus karena masih memiliki buku yang dipinjam';
} else {
    // Hapus dari database
    query("DELETE FROM anggota WHERE id = $id");
    $_SESSION['success'] = 'Anggota berhasil dihapus';
}

redirect('index.php');
?>