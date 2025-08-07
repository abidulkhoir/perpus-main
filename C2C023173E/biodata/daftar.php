<?php
include '../config/uts_web.php';
$result = $conn->query("SELECT * FROM biodata");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daftar Biodata</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
    }
    .table {
      background-color: #1e1e1e;
      color: #fff;
    }
    .table th, .table td {
      vertical-align: middle;
    }
    .btn {
      margin-right: 5px;
    }
    .container {
      margin-top: 50px;
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

<div class="container">
  <h2 class="mb-4">Daftar Biodata</h2>

  <table class="table table-dark table-striped table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
          <td><?= htmlspecialchars($row['alamat']) ?></td>
          <td>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

 <a href="../dashboard/dashboard.php" class="btn btn-outline-light mt-3">← Kembali ke Dashboard</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
