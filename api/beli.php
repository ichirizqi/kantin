<?php 
header('Content-Type: application/json');
include 'koneksi.php';

$idPembeli = $_POST['id_pembeli'];
$idMenu = $_POST['id_menu'];
$jumlah = $_POST['jumlah'];

$query = mysqli_query($koneksi,"SELECT * from keranjang WHERE id_menu = '$idMenu' and id_pembeli = '$idPembeli'");
$result = $query->fetch_assoc();
$cek = mysqli_num_rows($query);
if ($cek > 0) {
	$jumlah = $result['jumlah'] + $jumlah;
	$query = mysqli_query($koneksi,"UPDATE keranjang SET jumlah = '$jumlah' 
	WHERE id_menu = '$idMenu' and id_pembeli = '$idPembeli'");
} else {
    $query = mysqli_query($koneksi, "INSERT INTO keranjang (id_pembeli, id_menu, jumlah) 
	VALUES ('$idPembeli', $idMenu, $jumlah)");
}

if ($query){
    $data = [
        'success' => true,
    ];
} else {
    $data = [
        'success' => false
    ];
}

echo json_encode($data);