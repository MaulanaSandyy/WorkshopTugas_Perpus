<?php
require_once '../templates/header.php';
check_login(['admin']);
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $penulis = mysqli_real_escape_string($koneksi, $_POST['penulis']);
    $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun_terbit = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
    $sinopsis = mysqli_real_escape_string($koneksi, $_POST['sinopsis']);
    $stok = (int)$_POST['stok'];
    $nama_file_cover = '';

    // Logika Upload Cover
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        $target_dir = "../uploads/cover/";
        $nama_file_cover = time() . '_' . basename($_FILES["cover"]["name"]);
        $target_file = $target_dir . $nama_file_cover;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file gambar
        $check = getimagesize($_FILES["cover"]["tmp_name"]);
        if($check === false) {
            $errors[] = "File yang diupload bukan gambar.";
        }
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $errors[] = "Hanya format JPG, JPEG, PNG & GIF yang diizinkan.";
        }

        if (empty($errors)) {
            if (!move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
                $errors[] = "Maaf, terjadi error saat mengupload file.";
            }
        }
    }

    if (empty($errors)) {
        $query = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, stok, cover, sinopsis) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ssssiss", $judul, $penulis, $penerbit, $tahun_terbit, $stok, $nama_file_cover, $sinopsis);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['pesan'] = "Buku baru berhasil ditambahkan.";
            header("Location: " . $main_url . "buku/index.php");
            exit();
        } else {
            $errors[] = "Gagal menyimpan data ke database.";
        }
    }
}
?>
<h1 class="h3 mb-4">Tambah Buku Baru</h1>
<div class="card">
    <div class="card-body">
        <?php if (!empty($errors)): ?><div class="alert alert-danger"><?php foreach ($errors as $error): ?><p class="mb-0"><?php echo $error; ?></p><?php endforeach; ?></div><?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3"><label for="judul" class="form-label">Judul Buku</label><input type="text" class="form-control" id="judul" name="judul" required></div>
                    <div class="mb-3"><label for="penulis" class="form-label">Penulis</label><input type="text" class="form-control" id="penulis" name="penulis" required></div>
                    <div class="mb-3"><label for="penerbit" class="form-label">Penerbit</label><input type="text" class="form-control" id="penerbit" name="penerbit"></div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3"><label for="tahun_terbit" class="form-label">Tahun Terbit</label><input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" min="1500" max="<?php echo date('Y'); ?>"></div>
                    <div class="mb-3"><label for="stok" class="form-label">Stok</label><input type="number" class="form-control" id="stok" name="stok" min="0" value="1" required></div>
                </div>
            </div>
            <div class="mb-3"><label for="cover" class="form-label">Cover Buku</label><input type="file" class="form-control" id="cover" name="cover"></div>
            <div class="mb-3"><label for="sinopsis" class="form-label">Sinopsis</label><textarea class="form-control" id="sinopsis" name="sinopsis" rows="4"></textarea></div>
            <div class="d-flex justify-content-end">
                <a href="<?php echo $main_url; ?>buku/index.php" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Buku</button>
            </div>
        </form>
    </div>
</div>
<?php require_once '../templates/footer.php'; ?>
