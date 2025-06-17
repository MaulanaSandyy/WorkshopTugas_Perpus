<?php
require_once '../templates/header.php';
check_login();

$role = $_SESSION['role'];
$id_user = $_SESSION['user_id'];

// --- Logika untuk Admin dan Anggota ---
$status_filter = isset($_GET['status']) ? mysqli_real_escape_string($koneksi, $_GET['status']) : '';

// Query dasar untuk mengambil semua data yang dibutuhkan
// PERBAIKAN: Menambahkan p.id_user ke dalam SELECT statement
$sql = "SELECT p.id, p.id_user, u.username, b.judul, p.tanggal_pinjam, p.tanggal_jatuh_tempo, p.tanggal_kembali, p.status, p.denda
        FROM peminjaman p
        JOIN users u ON p.id_user = u.id
        JOIN buku b ON p.id_buku = b.id";

$where_clauses = [];
$params = [];
$types = '';

// Jika login sebagai anggota, filter hanya data mereka
if ($role === 'anggota') {
    $where_clauses[] = "p.id_user = ?";
    $params[] = $id_user;
    $types .= 'i';
}

// Jika admin menerapkan filter status
if ($role === 'admin' && !empty($status_filter)) {
    $where_clauses[] = "p.status = ?";
    $params[] = $status_filter;
    $types .= 's';
}

if (!empty($where_clauses)) {
    $sql .= " WHERE " . implode(' AND ', $where_clauses);
}

$sql .= " ORDER BY p.tanggal_pinjam DESC, p.id DESC";

$stmt = mysqli_prepare($koneksi, $sql);
if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Menentukan judul halaman berdasarkan role
$judul_halaman = ($role === 'admin') ? 'Seluruh Riwayat Peminjaman' : 'Riwayat Peminjaman Saya';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><?php echo $judul_halaman; ?></h1>
</div>

<?php if (isset($_SESSION['pesan'])) { echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>" . htmlspecialchars($_SESSION['pesan']) . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; unset($_SESSION['pesan']); } ?>

<!-- Tampilkan filter hanya untuk admin -->
<?php if ($role === 'admin'): ?>
<div class="card mb-4">
    <div class="card-body">
        <form action="" method="get" class="d-flex align-items-center">
            <label for="status" class="form-label me-2 mb-0">Filter Status:</label>
            <select name="status" id="status" class="form-select me-2" style="width: 200px;" onchange="this.form.submit()">
                <option value="">Semua</option>
                <option value="dipinjam" <?php echo ($status_filter === 'dipinjam') ? 'selected' : ''; ?>>Sedang Dipinjam</option>
                <option value="kembali" <?php echo ($status_filter === 'kembali') ? 'selected' : ''; ?>>Sudah Kembali</option>
            </select>
            <a href="<?php echo $main_url; ?>peminjaman/riwayat.php" class="btn btn-secondary">Reset</a>
        </form>
    </div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <?php if ($role === 'admin'): ?><th>Nama Peminjam</th><?php endif; ?>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): $no = 1; ?>
                        <?php while($pinjam = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <?php if ($role === 'admin'): ?><td><?php echo htmlspecialchars($pinjam['username']); ?></td><?php endif; ?>
                            <td><?php echo htmlspecialchars($pinjam['judul']); ?></td>
                            <td><?php echo date('d M Y', strtotime($pinjam['tanggal_pinjam'])); ?></td>
                            <td><?php echo date('d M Y', strtotime($pinjam['tanggal_jatuh_tempo'])); ?></td>
                            <td>
                                <?php if ($pinjam['status'] == 'dipinjam'): ?>
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Kembali</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <?php if ($pinjam['status'] == 'dipinjam' && $_SESSION['user_id'] == $pinjam['id_user']): ?>
                                    <a href="<?php echo $main_url; ?>peminjaman/kembalikan_proses.php?id=<?php echo $pinjam['id']; ?>" class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin ingin mengembalikan buku ini?')">Kembalikan</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="<?php echo ($role === 'admin') ? '7' : '6'; ?>" class="text-center py-5">
                            <h5 class="mt-3">Tidak ada data</h5>
                            <p class="text-muted">Belum ada riwayat peminjaman yang sesuai dengan filter.</p>
                        </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>
