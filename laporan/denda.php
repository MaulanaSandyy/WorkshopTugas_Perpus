<?php
require_once '../templates/header.php';
check_login(['admin']);

// Filter berdasarkan rentang tanggal
$start_date = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
$end_date = isset($_GET['end']) ? $_GET['end'] : date('Y-m-t');

$query_denda = "
    SELECT 
        p.id, u.username, b.judul, p.tanggal_kembali, p.tanggal_jatuh_tempo, p.denda
    FROM peminjaman p
    JOIN users u ON p.id_user = u.id
    JOIN buku b ON p.id_buku = b.id
    WHERE p.denda > 0 
    AND p.tanggal_kembali BETWEEN ? AND ?
    ORDER BY p.tanggal_kembali DESC
";
$stmt = mysqli_prepare($koneksi, $query_denda);
mysqli_stmt_bind_param($stmt, "ss", $start_date, $end_date);
mysqli_stmt_execute($stmt);
$result_denda = mysqli_stmt_get_result($stmt);

// Total denda pada periode terpilih
$total_denda = 0;
while($row = mysqli_fetch_assoc($result_denda)) {
    $total_denda += $row['denda'];
}
mysqli_data_seek($result_denda, 0);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Laporan Denda</h1>
    <a href="<?php echo $main_url; ?>laporan/index.php" class="btn btn-secondary">Kembali</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="" method="get" class="row g-3 align-items-center">
            <div class="col-auto"><label for="start" class="col-form-label">Dari Tanggal:</label></div>
            <div class="col-auto"><input type="date" class="form-control" id="start" name="start" value="<?php echo $start_date; ?>"></div>
            <div class="col-auto"><label for="end" class="col-form-label">Sampai Tanggal:</label></div>
            <div class="col-auto"><input type="date" class="form-control" id="end" name="end" value="<?php echo $end_date; ?>"></div>
            <div class="col-auto"><button type="submit" class="btn btn-primary">Filter</button></div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="card-title mb-0">Data Denda Periode <?php echo date('d M Y', strtotime($start_date)) . " - " . date('d M Y', strtotime($end_date)); ?></h5>
        <h5 class="mb-0">Total Denda: <span class="text-danger fw-bold">Rp <?php echo number_format($total_denda); ?></span></h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr><th>#</th><th>Username</th><th>Judul Buku</th><th>Jatuh Tempo</th><th>Dikembalikan</th><th class="text-end">Denda</th></tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result_denda) > 0): $no = 1; ?>
                        <?php while($data = mysqli_fetch_assoc($result_denda)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['username']); ?></td>
                            <td><?php echo htmlspecialchars($data['judul']); ?></td>
                            <td><?php echo date('d M Y', strtotime($data['tanggal_jatuh_tempo'])); ?></td>
                            <td><?php echo date('d M Y', strtotime($data['tanggal_kembali'])); ?></td>
                            <td class="text-end">Rp <?php echo number_format($data['denda']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center">Tidak ada data denda pada periode ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>
