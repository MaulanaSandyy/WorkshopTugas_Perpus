<?php
require_once '../templates/header.php';
check_login(['admin']);
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; // Tanpa hash sesuai permintaan
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
    
    // Validasi
    if (empty($username) || empty($password) || empty($nama_lengkap)) {
        $errors[] = "Username, Password, dan Nama Lengkap wajib diisi.";
    }

    // Cek duplikasi username
    $stmt_check = mysqli_prepare($koneksi, "SELECT id FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt_check, "s", $username);
    mysqli_stmt_execute($stmt_check);
    if (mysqli_stmt_get_result($stmt_check)->num_rows > 0) {
        $errors[] = "Username sudah digunakan. Silakan pilih username lain.";
    }
    mysqli_stmt_close($stmt_check);

    if (empty($errors)) {
        $query = "INSERT INTO users (username, password, nama_lengkap, alamat, no_telepon, role) VALUES (?, ?, ?, ?, ?, 'anggota')";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $username, $password, $nama_lengkap, $alamat, $no_telepon);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['pesan'] = "Anggota baru berhasil ditambahkan.";
            header("Location: " . $main_url . "anggota/index.php");
            exit();
        } else {
            $errors[] = "Gagal menyimpan data ke database.";
        }
    }
}
?>
<h1 class="h3 mb-4">Tambah Anggota Baru</h1>
<div class="card">
    <div class="card-body">
        <?php if (!empty($errors)): ?><div class="alert alert-danger"><?php foreach ($errors as $error): ?><p class="mb-0"><?php echo $error; ?></p><?php endforeach; ?></div><?php endif; ?>
        <form action="" method="POST">
            <div class="mb-3"><label for="nama_lengkap" class="form-label">Nama Lengkap</label><input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required></div>
            <div class="mb-3"><label for="username" class="form-label">Username</label><input type="text" class="form-control" id="username" name="username" required></div>
            <div class="mb-3"><label for="password" class="form-label">Password</label><input type="password" class="form-control" id="password" name="password" required></div>
            <div class="mb-3"><label for="no_telepon" class="form-label">No. Telepon</label><input type="text" class="form-control" id="no_telepon" name="no_telepon"></div>
            <div class="mb-3"><label for="alamat" class="form-label">Alamat</label><textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea></div>
            <div class="d-flex justify-content-end">
                <a href="<?php echo $main_url; ?>anggota/index.php" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Anggota</button>
            </div>
        </form>
    </div>
</div>
<?php require_once '../templates/footer.php'; ?>
