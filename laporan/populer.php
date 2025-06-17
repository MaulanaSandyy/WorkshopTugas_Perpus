<?php
require_once '../templates/header.php';
check_login(['admin']);

// Query untuk mengambil data buku paling populer
$query_populer = "
    SELECT 
        b.judul, 
        b.penulis, 
        COUNT(p.id_buku) AS jumlah_dipinjam
    FROM peminjaman p
    JOIN buku b ON p.id_buku = b.id
    GROUP BY p.id_buku
    ORDER BY jumlah_dipinjam DESC
    LIMIT 10;
";
$result_populer = mysqli_query($koneksi, $query_populer);

// Data untuk chart
$chart_labels = [];
$chart_data = [];
while($row = mysqli_fetch_assoc($result_populer)) {
    $chart_labels[] = $row['judul'];
    $chart_data[] = $row['jumlah_dipinjam'];
}
// Reset pointer result set untuk ditampilkan di tabel
mysqli_data_seek($result_populer, 0);

?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Laporan Buku Terpopuler</h1>
    <a href="<?php echo $main_url; ?>laporan/index.php" class="btn btn-secondary">Kembali</a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Top 10 Buku Paling Sering Dipinjam</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th class="text-center">Jumlah Dipinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result_populer) > 0): $no = 1; ?>
                                <?php while($buku = mysqli_fetch_assoc($result_populer)): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                                    <td><?php echo htmlspecialchars($buku['penulis']); ?></td>
                                    <td class="text-center"><span class="badge bg-primary rounded-pill"><?php echo $buku['jumlah_dipinjam']; ?> kali</span></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center">Belum ada data peminjaman.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Grafik Populer</h5>
            </div>
            <div class="card-body">
                <canvas id="chartPopuler"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Memuat Chart.js dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPopuler');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($chart_labels); ?>,
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: <?php echo json_encode($chart_data); ?>,
                backgroundColor: 'rgba(58, 117, 241, 0.5)',
                borderColor: 'rgba(58, 117, 241, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', // Membuat bar chart menjadi horizontal
            scales: {
                x: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>


<?php
require_once '../templates/footer.php';
?>
