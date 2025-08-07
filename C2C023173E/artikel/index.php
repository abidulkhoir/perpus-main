<?php
include '../config/uts_web.php';
$res = $conn->query("SELECT * FROM posts ORDER BY tanggal DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Artikel Terbaru</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
    }

    .card {
      background-color: #1e1e1e;
      border: none;
      color: #fff;
      overflow: hidden;
      position: relative;
      height: 300px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 1rem;
      transition: transform 0.3s;
      border-radius: 0.5rem;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .card::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-image: var(--bg-url);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      filter: brightness(0.5);
      z-index: 1;
      border-radius: 0.5rem;
      transition: filter 0.3s;
    }

    .card:hover::before {
      filter: brightness(0.3);
    }

    .card-content {
      position: relative;
      z-index: 2;
    }

    a, .btn-link {
      color: #0d6efd;
    }

    a:hover {
      color: #66b3ff;
    }

    .card-footer {
      border-top: 1px solid #333;
      background: transparent;
      position: relative;
      z-index: 2;
    }

    .btn-outline-light {
      border-color: #ddd;
    }
  </style>
</head>
<body>

<!-- Header -->
<header class="py-3 mb-4 border-bottom border-secondary">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">
    <h2 class="mb-0 text-white">Artikel Terbaru</h2>
    <a href="../auth/login.php" class="btn btn-outline-light">Login</a>
  </div>
</header>

<!-- Artikel Grid -->
<main class="py-4">
  <div class="album py-2 bg-dark">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        <?php while ($row = $res->fetch_assoc()): ?>
          <?php
            $gambarPath = !empty($row['gambar']) ? '../uploads/' . htmlspecialchars($row['gambar']) : '';
            $backgroundStyle = "style=\"--bg-url: url('$gambarPath');\"";
          ?>
          <div class="col">
            <div class="card shadow-sm" <?= $backgroundStyle ?>>
              <div class="card-content">
                <h5 class="card-title"><?= htmlspecialchars($row['judul']) ?></h5>
                <p class="card-text"><?= htmlspecialchars(substr($row['konten'], 0, 80)) ?>...</p>
                <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-light mt-2">Baca Selengkapnya</a>
              </div>
              <div class="card-footer text-end text-muted">
                <?= htmlspecialchars($row['tanggal']) ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
