<?php
session_start();
require_once '../../../config/database.php';
require_once '../../../functions/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../../../auth/login.php');
}

$title = 'Tambah Peminjaman';
$errors = [];
$success = '';

// Ambil daftar buku yang tersedia (stok > 0)
$available_books = query("SELECT * FROM buku WHERE jumlah_buku > 0 ORDER BY judul");

// Ambil daftar anggota
$members = query("SELECT * FROM anggota ORDER BY nama");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $buku_id = (int)$_POST['buku_id'];
    $anggota_id = (int)$_POST['anggota_id'];
    $tanggal_pinjam = escapeString($_POST['tanggal_pinjam']);
    $tanggal_kembali = date('Y-m-d', strtotime($tanggal_pinjam . ' +7 days'));
    
    // Validasi
    if (empty($buku_id)) {
        $errors[] = 'Buku harus dipilih';
    }
    if (empty($anggota_id)) {
        $errors[] = 'Anggota harus dipilih';
    }
    if (empty($tanggal_pinjam)) {
        $errors[] = 'Tanggal pinjam harus diisi';
    }
    
    // Cek stok buku
    $book = query("SELECT jumlah_buku FROM buku WHERE id = $buku_id")->fetch_assoc();
    if ($book['jumlah_buku'] < 1) {
        $errors[] = 'Stok buku tidak tersedia';
    }
    
    if (empty($errors)) {
        // Kurangi stok buku
        query("UPDATE buku SET jumlah_buku = jumlah_buku - 1 WHERE id = $buku_id");
        
        // Tambah peminjaman
        $admin_id = $_SESSION['user_id'];
        $sql = "INSERT INTO peminjaman (buku_id, anggota_id, admin_id, tanggal_pinjam, tanggal_kembali) 
                VALUES ($buku_id, $anggota_id, $admin_id, '$tanggal_pinjam', '$tanggal_kembali')";
        
        if (query($sql)) {
            $success = 'Peminjaman berhasil ditambahkan';
            $_POST = []; // Clear form
        } else {
            $errors[] = 'Gagal menambahkan peminjaman';
            // Kembalikan stok buku jika gagal
            query("UPDATE buku SET jumlah_buku = jumlah_buku + 1 WHERE id = $buku_id");
        }
    }
}

include '../../../includes/header.php';
include '../../../includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../../../includes/sidebar.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Tambah Peminjaman</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="buku_id" class="form-label">Buku</label>
                                    <select class="form-select" id="buku_id" name="buku_id" required>
                                        <option value="">-- Pilih Buku --</option>
                                        <?php while