<?php
header('Content-Type: application/json');
include 'koneksi.php';



$query = mysqli_query($koneksi,"SELECT * from keranjang as k 
INNER JOIN menu as m on k.id_menu = m.id_menu");
$totalHarga = 0;
while ($row = $query->fetch_assoc()) {
    $row['subtotal'] = $row['harga'] * $row['jumlah'];
    $totalHarga += $row['subtotal'];
    $keranjang[] = $row;
}

$data = [
    'keranjang' => $keranjang,
    'total' => $totalHarga
];

echo json_encode(['data' => $data]);

