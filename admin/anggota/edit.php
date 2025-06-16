<?php
session_start();
require_once '../../../config/database.php';
require_once '../../../functions/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../../../auth/login.php');
}

$title = 'Edit Anggota';
$errors = [];
$success = '';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data anggota
$member = query("SELECT * FROM anggota WHERE id = $id")->fetch_assoc();
if (!$member) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = escapeString($_POST['nim']);
    $nama = escapeString($_POST['nama']);
    $alamat = escapeString($_POST['alamat']);
    $no_telepon = escapeString($_POST['no_telepon']);
    $email = escapeString($_POST['email']);
    
    // Validasi
    if (empty($nim)) {
        $errors[] = 'NIM harus diisi';
    }
    if (empty($nama)) {
        $errors[] = 'Nama harus diisi';
    }
    if (empty($alamat)) {
        $errors[] = 'Alamat harus diisi';
    }
    if (empty($no_telepon)) {
        $errors[] = 'No. Telepon harus diisi';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email harus valid';
    }
    
    // Cek NIM sudah ada (kecuali untuk dirinya sendiri)
    $sql = "SELECT id FROM anggota WHERE nim = '$nim' AND id != $id";
    $result = query($sql);
    if ($result->num_rows > 0) {
        $errors[] = 'NIM sudah terdaftar';
    }
    
    // Cek email sudah ada (kecuali untuk dirinya sendiri)
    $sql = "SELECT id FROM anggota WHERE email = '$email' AND id != $id";
    $result = query($sql);
    if ($result->num_rows > 0) {
        $errors[] = 'Email sudah terdaftar';
    }
    
    if (empty($errors)) {
        $sql = "UPDATE anggota SET 
                nim = '$nim', 
                nama = '$nama', 
                alamat = '$alamat', 
                no_telepon = '$no_telepon', 
                email = '$email' 
                WHERE id = $id";
        
        if (query($sql)) {
            $success = 'Anggota berhasil diperbarui';
            // Ambil data anggota yang sudah diupdate
            $member = query("SELECT * FROM anggota WHERE id = $id")->fetch_assoc();
        } else {
            $errors[] = 'Gagal memperbarui anggota';
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
                <h1 class="h2">Edit Anggota</h1>
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
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim" value="<?= $member['nim'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $member['nama'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $member['alamat'] ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_telepon" class="form-label">No. Telepon</label>
                                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?= $member['no_telepon'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $member['email'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../../../includes/footer.php'; ?>