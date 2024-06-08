<?php
// Buat variabel yang digunakan untuk fungsi koneksi
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sekolah";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
