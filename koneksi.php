<?php
$host = "localhost";
$user = "root"; // Default XAMPP
$pass = "";     // Default XAMPP
$db   = "db_cafe";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>