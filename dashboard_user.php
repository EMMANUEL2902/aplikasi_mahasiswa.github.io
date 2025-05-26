<?php
session_start();
if ($_SESSION['role'] != 'user') {
  echo 'Akses ditolak!'; exit;
}
echo '<h2>Selamat Datang, User!</h2>';
?>