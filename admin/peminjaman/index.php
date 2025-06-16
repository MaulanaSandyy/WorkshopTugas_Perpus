<?php
session_start();
require_once '../../../config/database.php';
require_once '../../../functions/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../../../auth/login.php');
}

$title = 'Peminjaman Buku';
$search = isset($_GET['search']) ? escapeString($_GET['search']) : '';

$sql = "SELECT p.*, b.judul, a.nama 
        FROM peminjaman p
        JOIN buku b ON p.buku_id = b.id
        JOIN anggota a ON p.anggota_id = a.id
        WHERE p.status = 'dipinjam'";

if ($search) {
    $sql .= " AND (b.judul LIKE '%$search%' OR a.nama LIKE '%$search%')";
}

$sql .= " ORDER BY p.tanggal_kembali ASC";

$loans = query($sql);

include '../../../includes/header.php';
include '../../../includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../../../includes/sidebar.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Peminjaman Buku</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="tambah.php" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Peminjaman
                    </a>
                </div>
            </div>
            
            <!-- Search Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="search" placeholder="Cari peminjaman..." value="<?= $search ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                        <div class="col-md-2">
                            <a href="index.php" class="btn btn-secondary w-100">
                                <i class="fas fa-sync"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Loans Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Peminjaman Aktif</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="loansTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul Buku</th>
                                    <th>Nama Anggota</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Sisa Hari</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php while ($loan = $loans->fetch_assoc()): ?>
                                    <?php
                                    $tgl_kembali = new DateTime($loan['tanggal_kembali']);
                                    $today = new DateTime();
                                    $selisih = $today->diff($tgl_kembali);
                                    $sisa_hari = $selisih->days;
                                    $is_late = $today > $tgl_kembali;
                                    ?>
                                    <tr class="<?= $is_late ? 'table-danger' : '' ?>">
                                        <td><?= $no++ ?></td>
                                        <td><?= $loan['judul'] ?></td>
                                        <td><?= $loan['nama'] ?></td>
                                        <td><?= formatTanggal($loan['tanggal_pinjam']) ?></td>
                                        <td><?= formatTanggal($loan['tanggal_kembali']) ?></td>
                                        <td>
                                            <?php if ($is_late): ?>
                                                <span class="text-danger">Terlambat <?= $sisa_hari ?> hari</span>
                                            <?php else: ?>
                                                <?= $sisa_hari ?> hari lagi
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="kembali.php?id=<?= $loan['id'] ?>" class="btn btn-sm btn-primary" title="Pengembalian">
                                                <i class="fas fa-book"></i> Kembalikan
                                            </a>
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

<?php include '../../../includes/footer.php'; ?>