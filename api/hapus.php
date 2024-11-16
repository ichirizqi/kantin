<?php
header('Content-Type: application/json');
include 'koneksi.php';

$id_menu = $_POST['id_menu'];

$query = mysqli_query($koneksi,"DELETE FROM keranjang WHERE id_menu = '$id_menu'");
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