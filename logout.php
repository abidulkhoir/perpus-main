<?php
session_start();
session_destroy();
header("Location: ../artikel/index.php");
?>
