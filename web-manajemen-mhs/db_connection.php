<?php
// Nama service 'db' dari docker-compose.yml
$servername = "db";
// Sesuaikan dengan environment variables di docker-compose.yml untuk service 'db'
$username = "crud_user";
$password = "StrongPassword123!"; // Gunakan password yang sama
$dbname = "crud_app";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    // Tambahkan detail untuk debugging jika koneksi gagal
    die("Koneksi gagal: " . $conn->connect_error . " (Server: $servername, User: $username, DB: $dbname)");
}
// echo "Koneksi berhasil!"; // Hapus atau komentari ini setelah tes
?>