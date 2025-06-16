<?php
session_start();
require_once 'config/database.php';
require_once 'functions/functions.php';

if (!isLoggedIn()) {
    redirect('index.php');
}

$title = 'Dashboard';

// Hitung statistik
$total_buku = query("SELECT COUNT(*) as total FROM buku")->fetch_assoc()['total'];
$total_anggota = query("SELECT COUNT(*) as total FROM anggota")->fetch_assoc()['total'];
$total_peminjaman = query("SELECT COUNT(*) as total FROM peminjaman WHERE status = 'dipinjam'")->fetch_assoc()['total'];
$total_telat = query("SELECT COUNT(*) as total FROM peminjaman WHERE status = 'dipinjam' AND tanggal_kembali < CURDATE()")->fetch_assoc()['total'];

// Peminjaman terbaru
$peminjaman_terbaru = query("
    SELECT p.*, b.judul, a.nama 
    FROM peminjaman p
    JOIN buku b ON p.buku_id = b.id
    JOIN anggota a ON p.anggota_id = a.id
    ORDER BY p.created_at DESC LIMIT 5
");

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>
            
            <!-- Statistik -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Total Buku</h5>
                                    <h2 class="mb-0"><?= $total_buku ?></h2>
                                </div>
                                <i class="fas fa-book fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Total Anggota</h5>
                                    <h2 class="mb-0"><?= $total_anggota ?></h2>
                                </div>
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Buku Dipinjam</h5>
                                    <h2 class="mb-0"><?= $total_peminjaman ?></h2>
                                </div>
                                <i class="fas fa-exchange-alt fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Buku Telat</h5>
                                    <h2 class="mb-0"><?= $total_telat ?></h2>
                                </div>
                                <i class="fas fa-exclamation-triangle fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Peminjaman Terbaru -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Peminjaman Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul Buku</th>
                                    <th>Nama Anggota</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php while ($row = $peminjaman_terbaru->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['judul'] ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= formatTanggal($row['tanggal_pinjam']) ?></td>
                                        <td><?= formatTanggal($row['tanggal_kembali']) ?></td>
                                        <td>
                                            <?php if ($row['status'] == 'dipinjam'): ?>
                                                <span class="badge bg-warning text-dark">Dipinjam</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Dikembalikan</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include 'includes/footer.php'; ?>