<?php
require_once '../templates/header.php';
check_login(['admin']);
?>

<h1 class="h3 mb-4">Pusat Laporan</h1>
<div class="row">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-star-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Buku Terpopuler</h5>
                    </div>
                </div>
                <p class="card-text text-muted">Lihat daftar buku yang paling sering dipinjam oleh anggota perpustakaan.</p>
                <div class="mt-auto">
                    <a href="<?php echo $main_url; ?>laporan/populer.php" class="btn btn-outline-primary">Lihat Laporan</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-cash-coin fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Laporan Denda</h5>
                    </div>
                </div>
                <p class="card-text text-muted">Pantau semua denda keterlambatan pengembalian buku dari anggota.</p>
                <div class="mt-auto">
                    <a href="<?php echo $main_url; ?>laporan/denda.php" class="btn btn-outline-primary">Lihat Laporan</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-calendar-month fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Transaksi Peminjaman</h5>
                    </div>
                </div>
                <p class="card-text text-muted">Analisis tren peminjaman buku berdasarkan periode bulanan atau tahunan.</p>
                <div class="mt-auto">
                    <a href="<?php echo $main_url; ?>laporan/transaksi.php" class="btn btn-outline-primary">Lihat Laporan</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../templates/footer.php';
?>
