<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/uts_web.php';

$id = $_GET['id'];
$query = $conn->query("SELECT * FROM posts WHERE id = $id");
$artikel = $query->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $tanggal = $_POST['tanggal'];

    $gambarBaru = $artikel['gambar']; // default: gambar lama

    // Jika ada gambar baru diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $namaGambar = time() . '-' . basename($_FILES['gambar']['name']);
        $tujuan = '../uploads/' . $namaGambar;
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan)) {
            // Hapus gambar lama jika ada
            if (!empty($artikel['gambar']) && file_exists('../uploads/' . $artikel['gambar'])) {
                unlink('../uploads/' . $artikel['gambar']);
            }
            $gambarBaru = $namaGambar;
        }
    }

    $stmt = $conn->prepare("UPDATE posts SET judul = ?, konten = ?, tanggal = ?, gambar = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $judul, $konten, $tanggal, $gambarBaru, $id);
    $stmt->execute();

    header("Location: ../dashboard/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Artikel</title>
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
    a {
      color: #0d6efd;
    }
    a:hover {
      color: #66b3ff;
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
  <h3 class="mb-4">Edit Artikel</h3>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Judul</label>
      <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($artikel['judul']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal</label>
      <input type="date" name="tanggal" class="form-control" value="<?= $artikel['tanggal'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Konten</label>
      <textarea name="konten" class="form-control" rows="6" required><?= htmlspecialchars($artikel['konten']) ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Gambar Saat Ini</label><br>
      <?php if (!empty($artikel['gambar'])): ?>
        <img src="../uploads/<?= htmlspecialchars($artikel['gambar']) ?>" alt="Gambar" style="max-width:200px;">
      <?php else: ?>
        <p><em>Tidak ada gambar</em></p>
      <?php endif; ?>
    </div>
    <div class="mb-3">
      <label class="form-label">Ganti Gambar (opsional)</label>
      <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="../dashboard/dashboard.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
