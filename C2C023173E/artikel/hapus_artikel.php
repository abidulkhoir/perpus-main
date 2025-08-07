<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/uts_web.php';

$id = $_GET['id'];

// Amankan ID dan hapus
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../dashboard/dashboard.php");
exit;
