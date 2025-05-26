<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $jurusan = $_POST['jurusan'];
  $foto = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  if ($foto != '') {
    move_uploaded_file($tmp, "foto/" . $foto);
    mysqli_query($conn, "UPDATE mahasiswa SET nim='$nim', nama='$nama', jurusan='$jurusan', foto='$foto' WHERE id=$id");
  } else {
    mysqli_query($conn, "UPDATE mahasiswa SET nim='$nim', nama='$nama', jurusan='$jurusan' WHERE id=$id");
  }
  header('Location: dashboard_admin.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <h3>Edit Data Mahasiswa</h3>
  <form method="post" enctype="multipart/form-data">
    <input type="text" name="nim" class="form-control mb-2" value="<?= $row['nim'] ?>" required>
    <input type="text" name="nama" class="form-control mb-2" value="<?= $row['nama'] ?>" required>
    <input type="text" name="jurusan" class="form-control mb-2" value="<?= $row['jurusan'] ?>" required>
    <input type="file" name="foto" class="form-control mb-2">
    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
    <a href="dashboard_admin.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
