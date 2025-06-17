<?php
require_once '../templates/header.php';
check_login(['admin']);
$errors = [];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id == 0) {
    header("Location: " . $main_url . "anggota/index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
    $password = $_POST['password']; // Ambil password baru

    if (empty($nama_lengkap)) {
        $errors[] = "Nama Lengkap wajib diisi.";
    }
    
    if (empty($errors)) {
        // Query akan update password hanya jika field password diisi
        if (!empty($password)) {
            $query = "UPDATE users SET nama_lengkap = ?, alamat = ?, no_telepon = ?, password = ? WHERE id = ? AND role = 'anggota'";
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, "ssssi", $nama_lengkap, $alamat, $no_telepon, $password, $id);
        } else {
            $query = "UPDATE users SET nama_lengkap = ?, alamat = ?, no_telepon = ? WHERE id = ? AND role = 'anggota'";
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, "sssi", $nama_lengkap, $alamat, $no_telepon, $id);
        }
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['pesan'] = "Data anggota berhasil diperbarui.";
            header("Location: " . $main_url . "anggota/index.php");
            exit();
        } else {
            $errors[] = "Gagal memperbarui data.";
        }
    }
}

$stmt_select = mysqli_prepare($koneksi, "SELECT username, nama_lengkap, alamat, no_telepon FROM users WHERE id = ? AND role = 'anggota'");
mysqli_stmt_bind_param($stmt_select, "i", $id);
mysqli_stmt_execute($stmt_select);
$anggota = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_select));

if (!$anggota) {
    $_SESSION['pesan'] = "Data anggota tidak ditemukan.";
    header("Location: " . $main_url . "anggota/index.php");
    exit();
}
?>
<h1 class="h3 mb-4">Edit Data Anggota: <?php echo htmlspecialchars($anggota['nama_lengkap']); ?></h1>
<div class="card">
    <div class="card-body">
        <?php if (!empty($errors)): ?><div class="alert alert-danger"><?php foreach ($errors as $error): ?><p class="mb-0"><?php echo $error; ?></p><?php endforeach; ?></div><?php endif; ?>
        <form action="" method="POST">
            <div class="mb-3"><label for="username" class="form-label">Username</label><input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($anggota['username']); ?>" disabled readonly></div>
            <div class="mb-3"><label for="nama_lengkap" class="form-label">Nama Lengkap</label><input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($anggota['nama_lengkap']); ?>" required></div>
            <div class="mb-3"><label for="password" class="form-label">Password Baru</label><input type="password" class="form-control" id="password" name="password"><small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small></div>
            <div class="mb-3"><label for="no_telepon" class="form-label">No. Telepon</label><input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo htmlspecialchars($anggota['no_telepon']); ?>"></div>
            <div class="mb-3"><label for="alamat" class="form-label">Alamat</label><textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo htmlspecialchars($anggota['alamat']); ?></textarea></div>
            <div class="d-flex justify-content-end">
                <a href="<?php echo $main_url; ?>anggota/index.php" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Update Anggota</button>
            </div>
        </form>
    </div>
</div>
<?php require_once '../templates/footer.php'; ?>
