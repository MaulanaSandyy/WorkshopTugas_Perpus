<?php
session_start();
require_once '../config/database.php';
require_once '../functions/functions.php';

$title = 'Register';
$error = '';
$success = '';

if (isLoggedIn()) {
    redirect('../dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = escapeString($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $nama_lengkap = escapeString($_POST['nama_lengkap']);
    $email = escapeString($_POST['email']);
    
    // Validasi
    if ($password !== $confirm_password) {
        $error = 'Password dan konfirmasi password tidak sama';
    } else {
        // Cek username sudah ada
        $sql = "SELECT id FROM users WHERE username = '$username'";
        $result = query($sql);
        if ($result->num_rows > 0) {
            $error = 'Username sudah digunakan';
        } else {
            // Cek email sudah ada
            $sql = "SELECT id FROM users WHERE email = '$email'";
            $result = query($sql);
            if ($result->num_rows > 0) {
                $error = 'Email sudah digunakan';
            } else {
                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert user
                $sql = "INSERT INTO users (username, password, nama_lengkap, email, role) 
                        VALUES ('$username', '$hashed_password', '$nama_lengkap', '$email', 'anggota')";
                
                if (query($sql)) {
                    $success = 'Pendaftaran berhasil. Silakan login.';
                } else {
                    $error = 'Terjadi kesalahan saat mendaftar';
                }
            }
        }
    }
}

include '../includes/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title text-center">Registrasi Anggota</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                        <div class="text-center">
                            <a href="login.php" class="btn btn-primary">Kembali ke Login</a>
                        </div>
                    <?php else: ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    Sudah punya akun? <a href="login.php">Login disini</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>