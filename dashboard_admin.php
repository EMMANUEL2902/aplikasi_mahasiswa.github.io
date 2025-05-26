<?php
session_start();
if ($_SESSION['role'] != 'admin') {
  echo "Akses ditolak!"; exit;
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

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Dashboard Admin</h3>
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>

  <div class="card mb-4">
    <div class="card-header bg-primary text-white">Tambah Mahasiswa</div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data">
        <div class="row g-3">
          <div class="col-md-4">
            <input type="text" name="nim" class="form-control" placeholder="NIM" required>
          </div>
          <div class="col-md-4">
            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
          </div>
          <div class="col-md-4">
            <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" required>
          </div>
        </div>
        <div class="mt-3">
          <input type="file" name="foto" class="form-control">
        </div>
        <div class="mt-3">
          <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header bg-secondary text-white">Daftar Mahasiswa</div>
    <div class="card-body">
      <a href="export_excel.php" class="btn btn-sm btn-outline-primary mb-3">Export Excel</a>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th><th>NIM</th><th>Nama</th><th>Jurusan</th><th>Foto</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $data = mysqli_query($conn, "SELECT * FROM mahasiswa");
          while ($row = mysqli_fetch_assoc($data)) {
            echo "<tr>
              <td>$no</td>
              <td>{$row['nim']}</td>
              <td>{$row['nama']}</td>
              <td>{$row['jurusan']}</td>
              <td><img src='foto/{$row['foto']}' width='60'></td>
              <td>
                <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                <a href='hapus.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick="return confirm('Hapus?')">Hapus</a>
              </td>
            </tr>";
            $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
