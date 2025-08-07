<?php
include '../config/uts_web.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID tidak valid.";
    exit;
}

$id = (int) $_GET['id'];
$data = $conn->query("SELECT * FROM biodata WHERE id=$id")->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE biodata SET nama=?, email=?, jenis_kelamin=?, alamat=? WHERE id=?");
    $stmt->bind_param("ssssi", $_POST['nama'], $_POST['email'], $_POST['gender'], $_POST['alamat'], $id);
    $stmt->execute();
    header("Location: daftar.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Biodata</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
    }

    .form-container {
      background-color: #1e1e1e;
      padding: 30px;
      border-radius: 10px;
      max-width: 600px;
      margin: 60px auto;
      box-shadow: 0 0 15px rgba(0,0,0,0.6);
    }

    label {
      margin-top: 15px;
    }

    input[type="text"],
    textarea {
      background-color: #2a2a2a;
      color: #f1f1f1;
      border: 1px solid #444;
      border-radius: 5px;
      padding: 10px;
      width: 100%;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    .gender-group {
      display: flex;
      gap: 15px;
      margin-top: 5px;
    }

    input[type="radio"] {
      accent-color: #0d6efd;
    }

    button[type="submit"] {
      margin-top: 20px;
      padding: 10px 20px;
      border: none;
      background-color: #0d6efd;
      color: #fff;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
      background-color: #66b3ff;
    }

    a.btn-back {
      margin-top: 20px;
      display: inline-block;
      color: #fff;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Edit Biodata</h2>
  <form method="post">
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="<?= htmlspecialchars($data['email']) ?>" required>

    <label>Gender</label>
    <div class="gender-group">
      <input type="radio" id="pria" name="gender" value="Pria" <?= $data['jenis_kelamin'] == 'Pria' ? 'checked' : '' ?>>
      <label for="pria">Pria</label>

      <input type="radio" id="wanita" name="gender" value="Wanita" <?= $data['jenis_kelamin'] == 'Wanita' ? 'checked' : '' ?>>
      <label for="wanita">Wanita</label>
    </div>

    <label for="alamat">Alamat</label>
    <textarea name="alamat" id="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>

    <button type="submit">Update</button>
  </form>

  <a href="daftar.php" class="btn-back btn btn-outline-light mt-3">← Kembali ke Daftar</a>
</div>

</body>
</html>
