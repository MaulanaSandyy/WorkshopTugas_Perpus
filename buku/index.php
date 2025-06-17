<?php
require_once '../templates/header.php';
check_login();

// --- Logika Fitur Pencarian ---
$search_query = isset($_GET['q']) ? mysqli_real_escape_string($koneksi, $_GET['q']) : '';
$sql = "SELECT * FROM buku";
if (!empty($search_query)) {
    $sql .= " WHERE judul LIKE '%$search_query%' OR penulis LIKE '%$search_query%' OR penerbit LIKE '%$search_query%'";
}
$sql .= " ORDER BY judul ASC";
$result = mysqli_query($koneksi, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Katalog Buku</h1>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="<?php echo $main_url; ?>buku/tambah.php" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Buku Baru</a>
    <?php endif; ?>
</div>

<!-- Form Pencarian -->
<div class="card mb-4">
    <div class="card-body">
        <form action="" method="get" class="d-flex">
            <input type="text" name="q" class="form-control me-2" placeholder="Cari buku berdasarkan judul, penulis, atau penerbit..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit" class="btn btn-primary d-flex align-items-center"><i class="bi bi-search me-2"></i>Cari</button>
        </form>
    </div>
</div>

<?php if (isset($_SESSION['pesan'])) { echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>" . htmlspecialchars($_SESSION['pesan']) . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; unset($_SESSION['pesan']); } ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 8%;">Cover</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th class="text-center">Stok</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while($buku = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <img src="<?php echo $main_url; ?>uploads/cover/<?php echo !empty($buku['cover']) ? htmlspecialchars($buku['cover']) : 'default.png'; ?>" 
                                     alt="Cover <?php echo htmlspecialchars($buku['judul']); ?>" 
                                     style="width: 50px; height: 75px; object-fit: cover;" 
                                     class="rounded"
                                     onerror="this.onerror=null;this.src='https://placehold.co/50x75/EFEFEF/AAAAAA?text=No+Img';">
                            </td>
                            <td>
                                <strong class="d-block text-dark"><?php echo htmlspecialchars($buku['judul']); ?></strong>
                                <small class="text-muted"><?php echo htmlspecialchars($buku['penerbit']); ?> - <?php echo htmlspecialchars($buku['tahun_terbit']); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($buku['penulis']); ?></td>
                            <td class="text-center"><span class="badge fs-6 bg-<?php echo $buku['stok'] > 0 ? 'success-subtle text-success-emphasis' : 'danger-subtle text-danger-emphasis'; ?>"><?php echo $buku['stok']; ?></span></td>
                            <td class="text-end">
                                <?php if ($buku['stok'] > 0): ?>
                                    <!-- PERUBAHAN: Tombol ini sekarang membuka modal -->
                                    <button type="button" class="btn btn-primary btn-sm btn-pinjam" data-bs-toggle="modal" data-bs-target="#pinjamModal" data-id-buku="<?php echo $buku['id']; ?>" data-judul-buku="<?php echo htmlspecialchars($buku['judul']); ?>">Pinjam</button>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm" disabled>Stok Habis</button>
                                <?php endif; ?>
                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <a href="<?php echo $main_url; ?>buku/edit.php?id=<?php echo $buku['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                    <a href="<?php echo $main_url; ?>buku/hapus.php?id=<?php echo $buku['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus buku ini secara permanen?')"><i class="bi bi-trash"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center py-5">
                            <i class="bi bi-search fs-1 text-muted"></i>
                            <h5 class="mt-3">Buku Tidak Ditemukan</h5>
                            <p class="text-muted">Tidak ada buku yang cocok dengan kata kunci "<?php echo htmlspecialchars($search_query); ?>".</p>
                        </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Peminjaman -->
<div class="modal fade" id="pinjamModal" tabindex="-1" aria-labelledby="pinjamModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="pinjamModalLabel">Form Peminjaman Buku</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo $main_url; ?>peminjaman/pinjam_proses.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="id_buku" id="modal_id_buku">
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="modal_judul_buku" readonly>
            </div>
            <div class="mb-3">
                <label for="tanggal_jatuh_tempo" class="form-label">Pilih Tanggal Pengembalian</label>
                <input type="date" class="form-control" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Konfirmasi Pinjam</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?php require_once '../templates/footer.php'; ?>

<!-- JavaScript untuk Modal -->
<script>
    // Event listener untuk semua tombol dengan class .btn-pinjam
    document.querySelectorAll('.btn-pinjam').forEach(button => {
        button.addEventListener('click', function() {
            // Ambil data dari atribut data-* tombol yang diklik
            const bookId = this.getAttribute('data-id-buku');
            const bookTitle = this.getAttribute('data-judul-buku');

            // Masukkan data ke dalam form di modal
            document.getElementById('modal_id_buku').value = bookId;
            document.getElementById('modal_judul_buku').value = bookTitle;

            // Atur tanggal minimal untuk input date adalah besok
            const today = new Date();
            today.setDate(today.getDate() + 1);
            const tomorrow = today.toISOString().split('T')[0];
            document.getElementById('tanggal_jatuh_tempo').setAttribute('min', tomorrow);
        });
    });
</script>
