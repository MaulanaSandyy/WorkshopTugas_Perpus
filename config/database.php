<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'perpustakaan';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

function query($sql) {
    global $conn;
    $result = $conn->query($sql);
    if (!$result) {
        die("Query error: " . $conn->error);
    }
    return $result;
}

function escapeString($str) {
    global $conn;
    return $conn->real_escape_string($str);
}
?>