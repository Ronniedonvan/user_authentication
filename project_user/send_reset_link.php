<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50));

    $sql = "UPDATE users SET reset_token='$token' WHERE email='$email'";
    if (mysqli_query($conn, $sql)) {
        $resetLink = "http://yourdomain.com/reset_password.php?token=$token";
        $subject = "Password Reset";
        $message = "Click on this link to reset your password: $resetLink";
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "A reset link has been sent to your email.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "Email not found.";
    }
}
?>
