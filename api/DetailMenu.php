<?php
header('Content-Type: application/json');
include 'koneksi.php';

$idMenu = $_GET['id_menu'];

$query = mysqli_query($koneksi,"select * from menu where id_menu = '$idMenu'");
while ($row = $query->fetch_assoc()) {
    $data['id_menu'] = $row['id_menu'];
    $data['nama_menu'] = $row['nama_menu'];
    $data['harga'] = 'Rp '.number_format($row['harga'],2,',','.');;
    $data['gambar'] = $row['gambar'];
    $data['deskripsi'] = $row['deskripsi'];
}

echo json_encode(['data' => $data]);