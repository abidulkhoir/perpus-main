<?php
include '../config/uts_web.php';
$id = $_GET['id'];
$conn->query("DELETE FROM biodata WHERE id=$id");
header("Location: daftar.php");
?>
