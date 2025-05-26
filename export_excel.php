<?php
header('Content-Type: application/vnd-ms-excel');
header('Content-Disposition: attachment; filename=mahasiswa.xls');
include 'koneksi.php';
$result = mysqli_query($conn, 'SELECT * FROM mahasiswa');
echo '<table border=1><tr><th>NIM</th><th>Nama</th><th>Jurusan</th></tr>';
while($row = mysqli_fetch_assoc($result)) {
  echo '<tr><td>'.$row['nim'].'</td><td>'.$row['nama'].'</td><td>'.$row['jurusan'].'</td></tr>';
}
echo '</table>';
?>