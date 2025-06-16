<?php
session_start();
require_once '../../../config/database.php';
require_once '../../../functions/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../../../auth/login.php');
}

$title = 'Manajemen Anggota';
$search = isset($_GET['search']) ? escapeString($_GET['search']) : '';

$sql = "SELECT * FROM anggota";
if ($search) {
    $sql .= " WHERE nama LIKE '%$search%' OR nim LIKE '%$search%' OR email LIKE '%$search%'";
}
$sql .= " ORDER BY nama ASC";

$members = query($sql);

include '../../../includes/header.php';
include '../../../includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../../../includes/sidebar.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manajemen Anggota</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="tambah.php" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Anggota
                    </a>
                </div>
            </div>
            
            <!-- Search Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="search" placeholder="Cari anggota..." value="<?= $search ?>">
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
            
            <!-- Members Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Anggota</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="membersTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php while ($member = $members->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $member['nim'] ?></td>
                                        <td><?= $member['nama'] ?></td>
                                        <td><?= $member['alamat'] ?></td>
                                        <td><?= $member['no_telepon'] ?></td>
                                        <td><?= $member['email'] ?></td>
                                        <td>
                                            <a href="edit.php?id=<?= $member['id'] ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="hapus.php?id=<?= $member['id'] ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                                                <i class="fas fa-trash"></i>
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