<?php
session_start();
include '../config/uts_web.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($pass, $row['password_hash'])) {
            $_SESSION['user'] = $user;
            header("Location: ../dashboard/dashboard.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
    }
    .login-container {
      max-width: 400px;
      margin: 100px auto;
      background-color: #1e1e1e;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.5);
    }
    label {
      font-weight: 500;
    }
    .form-control {
      background-color: #2a2a2a;
      color: #fff;
      border: 1px solid #444;
    }
    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: none;
      background-color: #2a2a2a;
      color: #fff;
    }
  </style>
</head>
<body>

<div class="login-container">
  <h3 class="text-center mb-4">Login</h3>

  <?php if ($error): ?>
    <div class="alert alert-danger text-center py-2"><?= $error ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" id="username" required>
    </div>
    <div class="mb-3">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Masuk</button>
  </form>
</div>

</body>
</html>
