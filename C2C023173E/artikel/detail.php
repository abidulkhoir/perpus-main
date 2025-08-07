<?php
session_start(); // tetap dibutuhkan untuk konsistensi login jika ada
include '../config/uts_web.php';

if (!isset($_GET['id'])) {
    echo "ID artikel tidak ditemukan.";
    exit;
}

$id = (int) $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "Artikel tidak ditemukan.";
    exit;
}

$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($row['judul']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
    }
    a.btn {
      margin-bottom: 20px;
    }
    img {
      max-height: 400px;
      object-fit: cover;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="mb-4">
    <?php
      // Logika tombol kembali: dari dashboard atau index
      $backLink = (isset($_GET['from']) && $_GET['from'] === 'dashboard') 
                  ? '../dashboard/dashboard.php' 
                  : 'index.php';
    ?>
    <a href="<?= $backLink ?>" class="btn btn-outline-light">← Kembali</a>
  </div>

  <?php if (!empty($row['gambar'])): ?>
    <img src="../uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid mb-4 shadow" alt="Gambar Artikel">
  <?php endif; ?>

  <h2><?= htmlspecialchars($row['judul']) ?></h2>
  <p class="text-muted"><?= htmlspecialchars($row['tanggal']) ?></p>
  <hr>
  <p style="white-space: pre-line"><?= nl2br(htmlspecialchars($row['konten'])) ?></p>
</div>

</body>
</html>
