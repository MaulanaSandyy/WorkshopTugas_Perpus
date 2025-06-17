<?php
require_once '../config/database.php'; // Tetap butuh koneksi dan $main_url
$error = '';

// Jika sudah login, langsung redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: ' . $main_url . 'index.php');
    exit;
}

// Logika proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    
    $stmt = mysqli_prepare($koneksi, "SELECT id, username, password, role FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        // Membandingkan password secara langsung (plain text)
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: ' . $main_url . 'index.php');
            exit;
        }
    }
    
    $error = "Username atau password salah.";
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PerpusPRO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bs-primary-rgb: 58, 117, 241;
            --bs-body-font-family: 'Inter', sans-serif;
        }
        
        /* Membuat layout flex untuk memposisikan footer di bawah */
        body {
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1; /* Mendorong footer ke bawah */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            border: none;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.08);
            border-radius: 1rem;
        }

        .form-control-lg {
            border-radius: 0.5rem;
            padding: 0.9rem 1rem;
        }
        
        .btn-primary {
            padding: 0.9rem 1rem;
            font-weight: 600;
            border-radius: 0.5rem;
        }

        footer {
            flex-shrink: 0; /* Mencegah footer menyusut */
        }
    </style>
</head>
<body>
    <main class="main-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center mb-4">
                        <h1 class="h2 fw-bold"><i class="bi bi-book-half text-primary"></i> Perpus<b>PRO</b></h1>
                        <p class="text-muted">Silakan login untuk melanjutkan ke sistem.</p>
                    </div>
                    <div class="card login-card p-4">
                        <div class="card-body">
                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <form action="<?php echo $main_url; ?>auth/login.php" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label fw-bold">Username</label>
                                    <input type="text" class="form-control form-control-lg" id="username" name="username" required>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <p class="text-muted">Belum punya akun? <a href="<?php echo $main_url; ?>auth/register.php" class="fw-bold text-decoration-none">Daftar di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer yang hanya untuk halaman login/register -->
    <footer class="py-4">
        <div class="container">
            <!-- PERBAIKAN: Mengubah kelas flexbox untuk menengahkan teks -->
            <div class="d-flex flex-column align-items-center justify-content-center small">
                <div class="text-muted">Tugas untuk memenuhi setifikat workshop.</div>
                <div class="text-muted">Copyright &copy; Maulana Sandy <?php echo date("Y"); ?></div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
