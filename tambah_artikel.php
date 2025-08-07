<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/uts_web.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $tanggal = $_POST['tanggal'];
    $gambar = '';

    // Pastikan folder uploads/ ada
    $upload_dir = '../uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Proses upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $namaGambar = time() . '-' . basename($_FILES['gambar']['name']);
        $tujuan = $upload_dir . $namaGambar;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan)) {
            $gambar = $namaGambar;
        }
    }

    if ($judul && $konten && $tanggal) {
        $stmt = $conn->prepare("INSERT INTO posts (judul, konten, tanggal, gambar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $judul, $konten, $tanggal, $gambar);
        $stmt->execute();

        header("Location: ../dashboard/dashboard.php");
        exit;
    } else {
        echo "<p style='color:red'>Semua field wajib diisi!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Artikel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
    }
    .navbar {
      background-color: #1e1e1e;
    }
    .form-control, .form-control:focus {
      background-color: #1e1e1e;
      color: #fff;
      border-color: #333;
    }
    .btn-primary {
      background-color: #0d6efd;
      border-color: #0d6efd;
    }
    .form-label {
      color: #ddd;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark px-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="../dashboard/dashboard.php">Dashboard</a>
  </div>
</nav>

<div class="container py-5">
  <h3 class="mb-4">Tambah Artikel Baru</h3>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Judul</label>
      <input name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Gambar (opsional)</label>
      <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>
    <div class="mb-3">
      <label class="form-label">Konten</label>
      <textarea name="konten" class="form-control" rows="6" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="../dashboard/dashboard.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

</body>
</html>
