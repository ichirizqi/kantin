<?php
header('Content-Type: application/json');
include 'koneksi.php';

try {
    $idPembeli = $_POST['id_pembeli'];
    
    mysqli_begin_transaction($koneksi);
    // 1. Insert data ke tabel pemesan lalu ambil IDnya
    $insertPemesananQuery = mysqli_query($koneksi, "INSERT INTO pemesanan (id_pembeli) 
    VALUES ('$idPembeli')");
    $insertedPemesananId = mysqli_insert_id($koneksi);
    // mengambil data keranjang sesuai id pembeli : 
    
    $dataKeranjangQuery = mysqli_query($koneksi,"SELECT * from keranjang as k 
    INNER JOIN menu as m on k.id_menu = m.id_menu WHERE k.id_pembeli = '$idPembeli'");
    // menghitung total yang harus dibayar sekaligus memasukan data ke tabel pemesanan produk

    $total = 0;
    while ($row = $dataKeranjangQuery->fetch_assoc()) {
        $idMenu = $row['id_menu'];
        $harga = $row['harga'];
        $jumlah = $row['jumlah'];
        
        $total += $harga * $jumlah;
        
        $insertPemesananProdukQuery = mysqli_query($koneksi, "INSERT INTO pemesanan_produk (id_pemesanan, id_menu, jumlah) 
        VALUES ($insertedPemesananId, $idMenu, $jumlah)");
    }
    
    // update data total harga keranjang
    $updateTotalHargaQuery = mysqli_query($koneksi,"UPDATE pemesanan SET total_harga = '$total' 
    WHERE id_pemesanan = '$'insertedPemesananId'");
    // hapus data dari keranjang
    $hapusDataKeranjangQuery = mysqli_query($koneksi,"DELETE FROM keranjang WHERE id_pembeli = '$idPembeli'");
    
    mysqli_commit($koneksi);

    $data = [
        'success' => true
    ];
} catch (Exception $e) {
    mysqli_rollback($mysqli);

    $data = [
        'success' => false,
    ];
}

echo json_encode($data);