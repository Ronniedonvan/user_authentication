<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $registration_number = $_POST['registration_number'];
    $user_id = $_SESSION['user_id'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'contactApp');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Save contact details
    $sql = "INSERT INTO contacts (user_id, mobile, email, address, registration_number) VALUES ('$user_id', '$mobile', '$email', '$address', '$registration_number')";
    if ($conn->query($sql) === TRUE) {
        echo "Contact details saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
