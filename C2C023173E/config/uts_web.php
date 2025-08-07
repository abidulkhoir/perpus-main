<?php
$conn = new mysqli("localhost", "root", "root", "uts_web");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);
?>
