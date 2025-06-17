<?php
// config/database.php

date_default_timezone_set('Asia/Jakarta');

// Detail Database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'db_perpustakaan';

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
    echo "Koneksi ke database gagal: " . mysqli_connect_error();
    exit();
}

// --- PENGATURAN APLIKASI ---

// URL Utama Aplikasi (WAJIB diakhiri dengan /)
$main_url = 'http://localhost/perpustakaan/';

// Pengaturan Peminjaman
define('LAMA_PEMINJAMAN', 7); // Durasi peminjaman dalam hari
define('DENDA_PER_HARI', 1000); // Denda keterlambatan per hari (Rp)

// --- AKHIR PENGATURAN ---

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function check_login($allowed_roles = []) {
    global $main_url;
    if (!isset($_SESSION['user_id'])) {
        header("Location: " . $main_url . "auth/login.php");
        exit;
    }
    if (!empty($allowed_roles) && !in_array($_SESSION['role'], $allowed_roles)) {
        echo "<div class='container mt-5'><div class='alert alert-danger'>Akses Ditolak. Anda tidak memiliki izin untuk halaman ini.</div> <a href='" . $main_url . "index.php' class='btn btn-primary'>Kembali ke Dashboard</a></div>";
        // Hentikan rendering sisa halaman
        require_once realpath(__DIR__ . '/../templates/footer.php');
        exit;
    }
}
?>
