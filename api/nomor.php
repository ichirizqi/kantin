<?php
header('Content-Type: application/json');
include 'koneksi.php'; 

$query = mysqli_query($koneksi, "SELECT * FROM pemesanan ORDER BY id_pemesanan DESC LIMIT 1");
$no = [];

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $data['id_pemesanan'] = $row['id_pemesanan'];
        $no = $data;
    }
    
    echo json_encode(['data' => $no]);
} else {
    // If no rows are returned
    echo json_encode([
        'success' => false,
        'message' => 'No records found.'
    ]);
}

?>
