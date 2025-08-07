<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
include '../config/uts_web.php';

$artikel = $conn->query("SELECT * FROM posts ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
    }
    .navbar {
      background-color: #1e1e1e;
    }
    .table-dark td, .table-dark th {
      background-color: #1e1e1e;
      border-color: #333;
    }
    .table-dark tbody tr:hover {
      background-color: #2a2a2a;
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

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark px-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="../biodata/form.php">Form Biodata</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../biodata/daftar.php">Data Biodata</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../artikel/tambah_artikel.php">Tambah Artikel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../auth/logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- CONTENT -->
<div class="container py-5">
  <h2 class="mb-4">Selamat datang, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>

  <h4>Daftar Artikel</h4>
  <table class="table table-dark table-bordered align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Judul</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($row = $artikel->fetch_assoc()): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['judul']) ?></td>
        <td><?= $row['tanggal'] ?></td>
        <!-- bagian tombol aksi -->
<td>
  <a href="../artikel/detail.php?id=<?= $row['id'] ?>&from=dashboard" class="btn btn-sm btn-outline-info">Lihat</a>
  <a href="../artikel/edit_artikel.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-warning">Edit</a>
  <a href="../artikel/hapus_artikel.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus artikel ini?')">Hapus</a>
</td>

      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
