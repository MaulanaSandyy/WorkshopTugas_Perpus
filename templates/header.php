<?php
// Memuat file konfigurasi yang berisi $main_url
if (file_exists(__DIR__ . '/../config/database.php')) {
    require_once __DIR__ . '/../config/database.php';
} 
// Fallback jika header dipanggil dari direktori root (seperti index.php)
else if (file_exists(__DIR__ . '/config/database.php')) {
     require_once __DIR__ . '/config/database.php';
}
else {
    die("File konfigurasi database.php tidak dapat ditemukan.");
}

$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? htmlspecialchars($_SESSION['username']) : '';
$role = $is_logged_in ? htmlspecialchars($_SESSION['role']) : '';

// Mendapatkan info direktori dan file saat ini untuk menandai menu aktif
$current_page = basename($_SERVER['SCRIPT_NAME']);
// Menggunakan SCRIPT_NAME untuk path yang lebih andal di berbagai server
$script_path = dirname($_SERVER['SCRIPT_NAME']);
$current_dir = basename($script_path);

// Khusus untuk halaman utama di root, set direktori ke 'perpustakaan' atau nama folder proyek Anda
if ($current_page == 'index.php' && ($script_path == '/' || $script_path == '/perpustakaan')) {
    $current_dir = 'perpustakaan';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PerpusPRO - Sistem Perpustakaan Profesional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bs-primary-rgb: 58, 117, 241;
            --bs-body-font-family: 'Inter', sans-serif;
        }
        body { background-color: #f0f2f5; }
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: 260px; z-index: 100;
            background-color: #ffffff;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
        }
        .main-content { margin-left: 260px; padding: 2rem; }
        .sidebar-header {
            padding: 1.5rem; text-align: center;
            border-bottom: 1px solid #e9ecef;
        }
        .sidebar-header .app-brand {
            font-size: 1.5rem; font-weight: 700;
            color: #343a40; text-decoration: none;
        }
        .sidebar .nav-link {
            color: #5a6a85; padding: 0.8rem 1.5rem;
            display: flex; align-items: center;
            font-weight: 500; border-radius: 0.375rem;
            margin: 0.2rem 1rem;
            transition: all 0.2s ease-in-out;
        }
        .sidebar .nav-link i { font-size: 1.2rem; margin-right: 0.8rem; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
            color: rgb(var(--bs-primary-rgb));
        }
        .top-header {
            background-color: #fff; padding: 1rem 2rem;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 2rem;
        }
        .card { border: none; box-shadow: 0 0 25px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
<?php if ($is_logged_in): ?>
<div class="sidebar">
    <div class="sidebar-header">
        <a href="<?php echo $main_url; ?>index.php" class="app-brand"><i class="bi bi-book-half text-primary"></i> Perpus<b>PRO</b></a>
    </div>
    <ul class="nav flex-column mt-3">
        <li class="nav-item"><a class="nav-link <?php echo ($current_dir == 'perpustakaan') ? 'active' : ''; ?>" href="<?php echo $main_url; ?>index.php"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_dir == 'buku') ? 'active' : ''; ?>" href="<?php echo $main_url; ?>buku/index.php"><i class="bi bi-journal-album"></i> Katalog Buku</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($current_dir == 'peminjaman') ? 'active' : ''; ?>" href="<?php echo $main_url; ?>peminjaman/riwayat.php"><i class="bi bi-clock-history"></i> Riwayat Peminjaman</a></li>
        
        <?php if ($role == 'admin'): ?>
            <li class="nav-item mt-3"><span class="nav-link text-muted" style="font-size: 0.8rem; padding-top: 0; padding-bottom: 0;">ADMINISTRATOR</span></li>
            <li class="nav-item"><a class="nav-link <?php echo ($current_dir == 'laporan') ? 'active' : ''; ?>" href="<?php echo $main_url; ?>laporan/index.php"><i class="bi bi-graph-up-arrow"></i> Laporan</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($current_dir == 'anggota') ? 'active' : ''; ?>" href="<?php echo $main_url; ?>anggota/index.php"><i class="bi bi-people-fill"></i> Manajemen Anggota</a></li>
        <?php endif; ?>
    </ul>
</div>
<div class="main-content">
    <header class="d-flex justify-content-end align-items-center mb-4">
         <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://placehold.co/40x40/3A75F1/FFFFFF?text=<?php echo strtoupper(substr($username, 0, 1)); ?>" alt="Avatar" width="40" height="40" class="rounded-circle me-2">
                <strong><?php echo $username; ?></strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?php echo $main_url; ?>auth/logout.php">Logout</a></li>
            </ul>
        </div>
    </header>
<?php endif; ?>
<!-- Konten utama akan dimulai di sini -->
