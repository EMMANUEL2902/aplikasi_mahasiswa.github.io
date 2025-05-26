<?php
session_start();
if ($_SESSION['role'] != 'admin') {
  echo "Akses ditolak!";
  exit;
}
include 'koneksi.php';

if (isset($_POST['tambah'])) {
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $jurusan = $_POST['jurusan'];
  $foto = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  if ($foto != '') {
    move_uploaded_file($tmp, "foto/" . $foto);
  }
  mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, jurusan, foto) VALUES ('$nim', '$nama', '$jurusan', '$foto')");
  header('Location: dashboard_admin.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<!-- isi HTML sama seperti kode yang kamu kirim -->
</body>
</html>
