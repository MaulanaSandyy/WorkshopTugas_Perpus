<?php
require_once '../templates/header.php';
check_login(['admin']);

// Logika Pencarian
$search_query = isset($_GET['q']) ? mysqli_real_escape_string($koneksi, $_GET['q']) : '';
$sql = "SELECT id, username, nama_lengkap, alamat, no_telepon FROM users WHERE role = 'anggota'";
if (!empty($search_query)) {
    $sql .= " AND (username LIKE '%$search_query%' OR nama_lengkap LIKE '%$search_query%')";
}
$sql .= " ORDER BY nama_lengkap ASC";
$result = mysqli_query($koneksi, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manajemen Anggota</h1>
    <a href="<?php echo $main_url; ?>anggota/tambah.php" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Anggota</a>
</div>

<!-- Form Pencarian -->
<div class="card mb-4">
    <div class="card-body">
        <form action="" method="get" class="d-flex">
            <input type="text" name="q" class="form-control me-2" placeholder="Cari berdasarkan username atau nama lengkap..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
        </form>
    </div>
</div>

<?php if (isset($_SESSION['pesan'])) { echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['pesan']) . "</div>"; unset($_SESSION['pesan']); } ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>No. Telepon</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): $no = 1; ?>
                        <?php while($anggota = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($anggota['username']); ?></td>
                            <td><?php echo htmlspecialchars($anggota['nama_lengkap']); ?></td>
                            <td><?php echo htmlspecialchars($anggota['no_telepon']); ?></td>
                            <td class="text-end">
                                <a href="<?php echo $main_url; ?>anggota/edit.php?id=<?php echo $anggota['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                <a href="<?php echo $main_url; ?>anggota/hapus.php?id=<?php echo $anggota['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus anggota ini? Peminjaman yang terkait juga akan terhapus.')"><i class="bi bi-trash"></i> Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center py-4">Tidak ada data anggota.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>
