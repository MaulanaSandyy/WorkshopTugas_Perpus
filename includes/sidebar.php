<div class="sidebar bg-light">
    <div class="sidebar-header p-3">
        <h5>Menu Navigasi</h5>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="../dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
        </li>
        <?php if (isAdmin()): ?>
            <li>
                <a href="#bookMenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-book me-2"></i> Manajemen Buku
                </a>
                <ul class="collapse list-unstyled" id="bookMenu">
                    <li><a href="../admin/buku/"><i class="fas fa-list me-2"></i> Daftar Buku</a></li>
                    <li><a href="../admin/buku/tambah.php"><i class="fas fa-plus me-2"></i> Tambah Buku</a></li>
                </ul>
            </li>
            <li>
                <a href="#memberMenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-users me-2"></i> Manajemen Anggota
                </a>
                <ul class="collapse list-unstyled" id="memberMenu">
                    <li><a href="../admin/anggota/"><i class="fas fa-list me-2"></i> Daftar Anggota</a></li>
                    <li><a href="../admin/anggota/tambah.php"><i class="fas fa-plus me-2"></i> Tambah Anggota</a></li>
                </ul>
            </li>
            <li>
                <a href="../admin/peminjaman/"><i class="fas fa-exchange-alt me-2"></i> Peminjaman Buku</a>
            </li>
            <li>
                <a href="../admin/riwayat/"><i class="fas fa-history me-2"></i> Riwayat Peminjaman</a>
            </li>
        <?php endif; ?>
    </ul>
</div>