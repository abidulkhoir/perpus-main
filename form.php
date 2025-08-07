<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form Biodata</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
      font-family: sans-serif;
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

    h2 {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Form Biodata</h2>
    <form action="proses.php" method="post">
      <label for="nama">Nama Lengkap</label>
      <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap..." required>

      <label for="email">Email</label>
      <input type="text" id="email" name="email" placeholder="Masukkan email..." required>

      <label>Gender</label>
      <div class="gender-group">
        <input type="radio" id="pria" name="gender" value="Pria" required>
        <label for="pria">Pria</label>
        <input type="radio" id="wanita" name="gender" value="Wanita">
        <label for="wanita">Wanita</label>
      </div>

      <label for="alamat">Alamat</label>
      <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap..." required></textarea>

      <button type="submit">Kirim</button>
    </form>
  </div>

</body>
</html>
