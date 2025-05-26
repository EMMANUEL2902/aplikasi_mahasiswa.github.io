<?php
session_start();
include 'koneksi.php';
$username = $_POST['username'];
$password = $_POST['password'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $_SESSION['username'] = $username;
  $_SESSION['role'] = $row['role'];
  if ($row['role'] == 'admin') {
    header('Location: dashboard_admin.php');
  } else {
    header('Location: dashboard_user.php');
  }
} else {
  echo 'Login gagal';
}
?>