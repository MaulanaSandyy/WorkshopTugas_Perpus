<?php
session_start();
require_once '../../../config/database.php';
require_once '../../../functions/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../../../auth/login.php');
}

$title = 'Manajemen Buku';
$search = isset($_GET['search']) ? escapeString($_GET['search']) : '';

$sql = "SELECT * FROM buku";
if ($search) {
    $sql .= " WHERE judul LIKE '%$search%' OR pengarang LIKE '%$search%' OR penerbit LIKE '%$search%'";
}
$sql .= " ORDER BY judul ASC";

$books = query($sql);

include '../../../includes/header.php';
include '../../../includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../../../includes/sidebar.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manajemen Buku</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="tambah.php" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Buku
                    </a>
                </div>
            </div>
            
            <!-- Search Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="search" placeholder="Cari buku..." value="<?= $search ?>">
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
            
            <!-- Books Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Buku</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="booksTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cover</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php while ($book = $books->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?php if ($book['gambar']): ?>
                                                <img src="../../../assets/img/<?= $book['gambar'] ?>" alt="Cover" width="50" class="img-thumbnail">
                                            <?php else: ?>
                                                <img src="https://via.placeholder.com/50" alt="No Cover" width="50" class="img-thumbnail">
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $book['judul'] ?></td>
                                        <td><?= $book['pengarang'] ?></td>
                                        <td><?= $book['penerbit'] ?></td>
                                        <td><?= $book['tahun_terbit'] ?></td>
                                        <td><?= $book['jumlah_buku'] ?></td>
                                        <td>
                                            <a href="edit.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="hapus.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus buku ini?')">
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