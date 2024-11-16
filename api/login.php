<?php
header('Content-Type: application/json');
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi,"select * from user where username = '$username' and password = '$password'");
$result = $query->fetch_assoc();
$cek = mysqli_num_rows($query);
if ($cek > 0){
    $data = [
        'success' => true,
        'data' => [
            'id_user' => $result['id_user']
        ]
    ];
} else {
    $data = [
        'success' => false
    ];
}

// $data = file_get_contents('http://localhost/kantin/user.json');
// $data = json_decode($data);

echo json_encode($data);