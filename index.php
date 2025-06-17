<?php
require_once 'templates/header.php';
check_login(); // Memastikan hanya user ter-login yang bisa akses

$username = htmlspecialchars($_SESSION['username']);
$role = htmlspecialchars($_SESSION['role']);

// Ambil statistik sederhana
$total_buku = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM buku"))['total'];
$total_anggota = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users WHERE role = 'anggota'"))['total'];
$total_pinjam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM peminjaman WHERE status = 'dipinjam'"))['total'];
?>
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Selamat Datang, <?php echo $username; ?>!</h1>
        <p class="col-md-8 fs-4">Anda login sebagai <strong><?php echo $role; ?></strong>. Gunakan menu navigasi untuk mengelola data.</p>
    </div>
</div>
<div class="row text-center">
    <div class="col-md-4"><div class="card text-white bg-primary mb-3"><div class="card-header">Total Judul Buku</div><div class="card-body"><h1 class="card-title"><?php echo $total_buku; ?></h1><p class="card-text">Judul</p></div></div></div>
    <div class="col-md-4"><div class="card text-white bg-success mb-3"><div class="card-header">Total Anggota</div><div class="card-body"><h1 class="card-title"><?php echo $total_anggota; ?></h1><p class="card-text">Orang</p></div></div></div>
    <div class="col-md-4"><div class="card text-white bg-warning mb-3"><div class="card-header">Buku Sedang Dipinjam</div><div class="card-body"><h1 class="card-title"><?php echo $total_pinjam; ?></h1><p class="card-text">Eksemplar</p></div></div></div>
</div>
<div class="mt-5">
    <h2>Akses Cepat</h2><hr>
    <a href="<?php echo $main_url; ?>buku/index.php" class="btn btn-lg btn-outline-primary m-2"><i class="bi bi-journal-album"></i> Lihat Semua Buku</a>
    <a href="<?php echo $main_url; ?>peminjaman/riwayat.php" class="btn btn-lg btn-outline-secondary m-2"><i class="bi bi-clock-history"></i> Riwayat Peminjaman</a>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="<?php echo $main_url; ?>buku/tambah.php" class="btn btn-lg btn-outline-success m-2"><i class="bi bi-plus-circle"></i> Tambah Buku Baru</a>
    <?php endif; ?>
</div>
<?php require_once 'templates/footer.php'; ?>
