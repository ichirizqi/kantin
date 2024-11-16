<?php
header('Content-Type: application/json');
include 'koneksi.php'; // Including the connection file

// Retrieving data from POST request
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

// Basic validation checks
if (empty($nama) || empty($username) || empty($password) ) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

// Insert the new user into the database
$query = mysqli_query($koneksi, "INSERT INTO user (nama, username, password) VALUES ('$nama', '$username', '$password')");

if ($query) {
    $data = [
        'success' => true,
        'message' => 'User registered successfully!'
    ];
} else {
    $data = [
        'success' => false,
        'message' => 'Error registering user. Please try again.'
    ];
}

// Return the response as JSON
echo json_encode($data);
?>
