<?php
require_once '../config/database.php';
$errors = [];
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; // Password diambil langsung
    $password_confirm = $_POST['password_confirm'];

    // Validasi
    if (empty($username)) $errors[] = "Username tidak boleh kosong.";
    if (empty($password)) $errors[] = "Password tidak boleh kosong.";
    if ($password !== $password_confirm) $errors[] = "Konfirmasi password tidak cocok.";

    // Cek duplikasi username
    $stmt_check = mysqli_prepare($koneksi, "SELECT id FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt_check, "s", $username);
    mysqli_stmt_execute($stmt_check);
    if (mysqli_stmt_get_result($stmt_check)->num_rows > 0) {
        $errors[] = "Username sudah terdaftar.";
    }
    mysqli_stmt_close($stmt_check);

    // Jika tidak ada error
    if (empty($errors)) {
        // PERUBAHAN: Password tidak di-hash lagi
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Baris ini dihapus

        // Masukkan data ke database dengan password asli
        $stmt_insert = mysqli_prepare($koneksi, "INSERT INTO users (username, password, role) VALUES (?, ?, 'anggota')");
        // PERUBAHAN: Menggunakan variabel $password langsung, bukan $hashed_password
        mysqli_stmt_bind_param($stmt_insert, "ss", $username, $password);
        
        if (mysqli_stmt_execute($stmt_insert)) {
            $success_message = "Registrasi berhasil! Silakan <a href='" . $main_url . "auth/login.php'>login</a>.";
        } else {
            $errors[] = "Gagal mendaftar.";
        }
        mysqli_stmt_close($stmt_insert);
    }
}

require_once '../templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center"><h4 class="mb-0">Registrasi Anggota Baru</h4></div>
            <div class="card-body">
                <?php if (!empty($errors)): ?><div class="alert alert-danger"><?php foreach ($errors as $error): ?><p class="mb-0"><?php echo $error; ?></p><?php endforeach; ?></div><?php endif; ?>
                <?php if (!empty($success_message)): ?><div class="alert alert-success"><p class="mb-0"><?php echo $success_message; ?></p></div>
                <?php else: ?>
                    <form action="<?php echo $main_url; ?>auth/register.php" method="POST">
                        <div class="mb-3"><label for="username" class="form-label">Username</label><input type="text" class="form-control" id="username" name="username" required></div>
                        <div class="mb-3"><label for="password" class="form-label">Password</label><input type="password" class="form-control" id="password" name="password" required></div>
                        <div class="mb-3"><label for="password_confirm" class="form-label">Konfirmasi Password</label><input type="password" class="form-control" id="password_confirm" name="password_confirm" required></div>
                        <div class="d-grid"><button type="submit" class="btn btn-primary">Daftar</button></div>
                    </form>
                <?php endif; ?>
            </div>
            <div class="card-footer text-center"><p class="mb-0">Sudah punya akun? <a href="<?php echo $main_url; ?>auth/login.php">Login di sini</a></p></div>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>
