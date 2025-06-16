<?php
require_once __DIR__ . '/../config/database.php';

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function redirect($location) {
    header("Location: $location");
    exit();
}

function formatTanggal($date) {
    return date('d-m-Y', strtotime($date));
}

function hitungDenda($tgl_kembali, $tgl_dikembalikan, $denda_per_hari = 5000) {
    $tgl1 = new DateTime($tgl_kembali);
    $tgl2 = new DateTime($tgl_dikembalikan);
    
    if ($tgl2 <= $tgl1) {
        return 0;
    }
    
    $selisih = $tgl2->diff($tgl1);
    return $selisih->days * $denda_per_hari;
}

function uploadGambar($file, $target_dir = "../assets/img/") {
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return ['error' => 'File bukan gambar'];
    }
    
    // Check file size (max 2MB)
    if ($file["size"] > 2000000) {
        return ['error' => 'Ukuran file terlalu besar (max 2MB)'];
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        return ['error' => 'Hanya format JPG, JPEG, PNG & GIF yang diizinkan'];
    }
    
    // Generate unique filename
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ['success' => $new_filename];
    } else {
        return ['error' => 'Terjadi kesalahan saat upload gambar'];
    }
}
?>