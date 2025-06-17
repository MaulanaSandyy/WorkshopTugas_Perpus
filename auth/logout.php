<?php
require_once '../config/database.php';

// Hapus semua variabel session
$_SESSION = array();

// Hancurkan session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan session
session_destroy();

// Redirect ke halaman login
header("Location: " . $main_url . "auth/login.php");
exit;
?>
