<?php
// db_config.php - Konfigurasi Sambungan Pangkalan Data

$servername = "localhost";
$username = "root"; // Sila tukar jika anda menetapkan username lain pada XAMPP
$password = "password123";     // Sila tukar jika anda menetapkan password pada XAMPP
$dbname = "medic_vault_db";

// Mencipta sambungan
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa sambungan
if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}

// Menetapkan set aksara kepada utf8mb4 untuk keserasian dengan schema.sql
$conn->set_charset("utf8mb4");
?>