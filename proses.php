<?php
include '../config/uts_web.php';


$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$gender = $_POST['gender'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$errors = [];

if (empty($nama)) $errors[] = "Nama wajib diisi.";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email tidak valid.";
if (empty($gender)) $errors[] = "Jenis kelamin harus dipilih.";
if (empty($alamat)) $errors[] = "Alamat wajib diisi.";

if (!empty($errors)) {
    foreach ($errors as $e) echo "<p>$e</p>";
    echo "<a href='biodata/form.php'>Kembali</a>";
} else {
    $stmt = $conn->prepare("INSERT INTO biodata (nama, email, jenis_kelamin, alamat) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $gender, $alamat);
    $stmt->execute();
    echo "Data berhasil disimpan. <a href='daftar.php'>Lihat Data</a>";
}
?>
