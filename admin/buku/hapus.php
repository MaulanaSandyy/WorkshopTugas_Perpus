<?php
session_start();
require_once '../../../config/database.php';
require_once '../../../functions/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../../../auth/login.php');
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data buku untuk mendapatkan nama gambar
$book = query("SELECT gambar FROM buku WHERE id = $id")->fetch_assoc();

if ($book) {
    // Hapus gambar jika ada
    if ($book['gambar'] && file_exists("../../../assets/img/{$book['gambar']}")) {
        unlink("../../../assets/img/{$book['gambar']}");
    }
    
    // Hapus dari database
    query("DELETE FROM buku WHERE id = $id");
    
    $_SESSION['success'] = 'Buku berhasil dihapus';
} else {
    $_SESSION['error'] = 'Buku tidak ditemukan';
}

redirect('index.php');
?>