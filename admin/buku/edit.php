<?php
session_start();
require_once '../../../config/database.php';
require_once '../../../functions/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../../../auth/login.php');
}

$title = 'Edit Buku';
$errors = [];
$success = '';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data buku
$book = query("SELECT * FROM buku WHERE id = $id")->fetch_assoc();
if (!$book) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = escapeString($_POST['judul']);
    $pengarang = escapeString($_POST['pengarang']);
    $penerbit = escapeString($_POST['penerbit']);
    $tahun_terbit = escapeString($_POST['tahun_terbit']);
    $isbn = escapeString($_POST['isbn']);
    $jumlah_buku = escapeString($_POST['jumlah_buku']);
    
    // Validasi
    if (empty($judul)) {
        $errors[] = 'Judul buku harus diisi';
    }
    if (empty($pengarang)) {
        $errors[] = 'Pengarang harus diisi';
    }
    if (empty($penerbit)) {
        $errors[] = 'Penerbit harus diisi';
    }
    if (empty($tahun_terbit) || !is_numeric($tahun_terbit)) {
        $errors[] = 'Tahun terbit harus berupa angka';
    }
    if (empty($jumlah_buku) || !is_numeric($jumlah_buku)) {
        $errors[] = 'Jumlah buku harus berupa angka';
    }
    
    // Upload gambar baru jika ada
    $gambar = $book['gambar'];
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $upload = uploadGambar($_FILES['gambar']);
        if (isset($upload['error'])) {
            $errors[] = $upload['error'];
        } else {
            // Hapus gambar lama jika ada
            if ($gambar && file_exists("../../../assets/img/$gambar")) {
                unlink("../../../assets/img/$gambar");
            }
            $gambar = $upload['success'];
        }
    }
    
    if (empty($errors)) {
        $sql = "UPDATE buku SET 
                judul = '$judul', 
                pengarang = '$pengarang', 
                penerbit = '$penerbit', 
                tahun_terbit = '$tahun_terbit', 
                isbn = '$isbn', 
                jumlah_buku = '$jumlah_buku', 
                gambar = '$gambar' 
                WHERE id = $id";
        
        if (query($sql)) {
            $success = 'Buku berhasil diperbarui';
            // Ambil data buku yang sudah diupdate
            $book = query("SELECT * FROM buku WHERE id = $id")->fetch_assoc();
        } else {
            $errors[] = 'Gagal memperbarui buku';
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
                <h1 class="h2">Edit Buku</h1>
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
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $book['judul'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pengarang" class="form-label">Pengarang</label>
                                    <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= $book['pengarang'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="penerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $book['penerbit'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?= $book['tahun_terbit'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="isbn" class="form-label">ISBN (opsional)</label>
                                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $book['isbn'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                                    <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" value="<?= $book['jumlah_buku'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Cover Buku (opsional)</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                            <?php if ($book['gambar']): ?>
                                <div class="mt-2">
                                    <img src="../../../assets/img/<?= $book['gambar'] ?>" alt="Current Cover" width="100" class="img-thumbnail">
                                    <p class="text-muted mt-1">Gambar saat ini</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../../../includes/footer.php'; ?>