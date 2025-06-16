<?php
session_start();
require_once 'config/database.php';

$username = trim($_POST['username']);
$password = $_POST['password'];

// Cek berdasarkan username atau email
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Cek password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id']     = $user['id'];
        $_SESSION['username']    = $user['username'];
        $_SESSION['nama']        = $user['nama_lengkap'];
        $_SESSION['role']        = $user['role'];

        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: login.php?error=Password salah!");
        exit();
    }
} else {
    header("Location: login.php?error=Username atau email tidak ditemukan!");
    exit();
}
