<?php
require_once '../templates/header.php';
check_login(['admin']);
$errors = [];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id == 0) {
    $_SESSION['pesan'] = "ID Buku tidak valid.";
    header("Location: " . $main_url . "buku/index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $penulis = mysqli_real_escape_string($koneksi, $_POST['penulis']);
    $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun_terbit = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
    $stok = (int)$_POST['stok'];

    if (empty($judul) || empty($penulis)) $errors[] = "Judul dan Penulis wajib diisi.";
    
    if (empty($errors)) {
        $query = "UPDATE buku SET judul = ?, penulis = ?, penerbit = ?, tahun_terbit = ?, stok = ? WHERE id = ?";
        $stmt_update = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt_update, "sssisi", $judul, $penulis, $penerbit, $tahun_terbit, $stok, $id);
        if (mysqli_stmt_execute($stmt_update)) {
            $_SESSION['pesan'] = "Data buku berhasil diperbarui.";
            header("Location: " . $main_url . "buku/index.php");
            exit();
        } else {
            $errors[] = "Gagal memperbarui data.";
        }
    }
}

$stmt_select = mysqli_prepare($koneksi, "SELECT * FROM buku WHERE id = ?");
mysqli_stmt_bind_param($stmt_select, "i", $id);
mysqli_stmt_execute($stmt_select);
$buku = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_select));
if (!$buku) {
    $_SESSION['pesan'] = "Data buku tidak ditemukan.";
    header("Location: " . $main_url . "buku/index.php");
    exit();
}
?>
<h3>Edit Data Buku</h3><hr>
<div class="card shadow-sm col-md-8">
    <div class="card-body">
        <?php if (!empty($errors)): ?><div class="alert alert-danger"><?php foreach ($errors as $error): ?><p><?php echo $error; ?></p><?php endforeach; ?></div><?php endif; ?>
        <form action="<?php echo $main_url; ?>buku/edit.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3"><label for="judul" class="form-label">Judul Buku</label><input type="text" class="form-control" id="judul" name="judul" value="<?php echo htmlspecialchars($buku['judul']); ?>" required></div>
            <div class="mb-3"><label for="penulis" class="form-label">Penulis</label><input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo htmlspecialchars($buku['penulis']); ?>" required></div>
            <div class="mb-3"><label for="penerbit" class="form-label">Penerbit</label><input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo htmlspecialchars($buku['penerbit']); ?>"></div>
            <div class="mb-3"><label for="tahun_terbit" class="form-label">Tahun Terbit</label><input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?php echo htmlspecialchars($buku['tahun_terbit']); ?>"></div>
            <div class="mb-3"><label for="stok" class="form-label">Stok</label><input type="number" class="form-control" id="stok" name="stok" value="<?php echo htmlspecialchars($buku['stok']); ?>" required></div>
            <a href="<?php echo $main_url; ?>buku/index.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
<?php require_once '../templates/footer.php'; ?>
