<?php
// api/index.php - Front Controller for Vercel Deployment

// Get the request URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = urldecode($uri);

// Remove leading/trailing slashes
$uri = trim($uri, '/');

// If empty, default to root index
if (empty($uri)) {
    $uri = 'index.php';
}

// Map URI to file
$file = $uri;

// Check if file exists in root directory
$rootDir = dirname(__DIR__);
$fullPath = $rootDir . '/' . $file;

// If the file doesn't have .php extension, try adding it
if (!file_exists($fullPath) && pathinfo($file, PATHINFO_EXTENSION) !== 'php') {
    $fullPath .= '.php';
}

// If file exists, include it
if (file_exists($fullPath) && is_file($fullPath)) {
    // Change to root directory so relative paths work
    chdir($rootDir);
    require $fullPath;
} else {
    // 404 Not Found
    http_response_code(404);
    echo '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | PerpusPRO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-muted">404</h1>
        <p class="fs-4 text-muted">Halaman tidak ditemukan</p>
        <a href="/" class="btn btn-primary">Kembali ke Dashboard</a>
    </div>
</body>
</html>';
}
