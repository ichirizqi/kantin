<?php
header('Content-Type: application/json');
include 'koneksi.php';

$query = mysqli_query($koneksi,"select * from menu where id_kantin = 6");
while ($row = $query->fetch_assoc()) {
    $data['id_menu'] = $row['id_menu'];
    $data['nama_menu'] = $row['nama_menu'];
    $data['harga'] = 'Rp '.number_format($row['harga'],2,',','.');;
    $data['gambar'] = $row['gambar'];
    $data['deskripsi'] = $row['deskripsi'];

    $menu[] = $data;
}

echo json_encode(['data' => $menu]);