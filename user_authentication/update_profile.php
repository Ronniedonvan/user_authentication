<?php
session_start();
include 'config.php';

$username = $_POST['username'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$registration = $_POST['registration'];

$query = "UPDATE users SET email='$email', mobile='$mobile', address='$address', registration='$registration' WHERE username='$username'";
if (mysqli_query($conn, $query)) {
    echo json_encode(['message' => 'Profile updated successfully']);
} else {
    echo json_encode(['message' => 'Failed to update profile']);
}
?>
