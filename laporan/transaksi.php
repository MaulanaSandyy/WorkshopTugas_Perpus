<?php
require_once '../templates/header.php';
check_login(['admin']);

$filter_bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$filter_tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

$query_transaksi = "
    SELECT 
        DATE(tanggal_pinjam) as tanggal,
        COUNT(id) as jumlah_peminjaman
    FROM peminjaman
    WHERE MONTH(tanggal_pinjam) = ? AND YEAR(tanggal_pinjam) = ?
    GROUP BY DATE(tanggal_pinjam)
    ORDER BY tanggal ASC
";
$stmt = mysqli_prepare($koneksi, $query_transaksi);
mysqli_stmt_bind_param($stmt, "ss", $filter_bulan, $filter_tahun);
mysqli_stmt_execute($stmt);
$result_transaksi = mysqli_stmt_get_result($stmt);

// Data untuk chart
$chart_labels = [];
$chart_data = [];
$total_peminjaman = 0;
while($row = mysqli_fetch_assoc($result_transaksi)) {
    $chart_labels[] = date('d M', strtotime($row['tanggal']));
    $chart_data[] = $row['jumlah_peminjaman'];
    $total_peminjaman += $row['jumlah_peminjaman'];
}
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Laporan Transaksi Peminjaman</h1>
    <a href="<?php echo $main_url; ?>laporan/index.php" class="btn btn-secondary">Kembali</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="" method="get" class="row g-3 align-items-center">
            <div class="col-auto"><label class="col-form-label">Pilih Periode:</label></div>
            <div class="col-auto">
                <select name="bulan" class="form-select">
                    <?php for($i=1; $i<=12; $i++): $nama_bulan = date('F', mktime(0, 0, 0, $i, 10)); ?>
                        <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>" <?php echo ($i == $filter_bulan) ? 'selected' : ''; ?>><?php echo $nama_bulan; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-auto">
                <select name="tahun" class="form-select">
                    <?php for($i=date('Y'); $i>=2020; $i--): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($i == $filter_tahun) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-auto"><button type="submit" class="btn btn-primary">Tampilkan</button></div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="card-title mb-0">Grafik Peminjaman Bulan <?php echo date('F Y', mktime(0,0,0, $filter_bulan, 1, $filter_tahun)); ?></h5>
        <h5 class="mb-0">Total Peminjaman: <span class="fw-bold"><?php echo $total_peminjaman; ?></span></h5>
    </div>
    <div class="card-body">
        <canvas id="chartTransaksi" height="100"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartTransaksi');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($chart_labels); ?>,
            datasets: [{
                label: 'Jumlah Peminjaman Harian',
                data: <?php echo json_encode($chart_data); ?>,
                fill: true,
                backgroundColor: 'rgba(58, 117, 241, 0.2)',
                borderColor: 'rgba(58, 117, 241, 1)',
                tension: 0.1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });
</script>

<?php require_once '../templates/footer.php'; ?>
