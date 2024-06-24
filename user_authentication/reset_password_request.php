<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // Generate a unique token

    // Store the token in the database with an expiry time
    $sql = "UPDATE users SET reset_token='$token', token_expiry=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email='$email'";
    if (mysqli_query($conn, $sql)) {
        $resetLink = "http://localhost/user_authentication/reset_password.php?token=$token";

        $subject = "Password Reset Request";
        $message = "Hi,\n\nPlease click the link below to reset your password:\n$resetLink\n\nIf you did not request a password reset, please ignore this email.";
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "An email has been sent to your email address with instructions to reset your password.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "Failed to generate reset link.";
    }
}
?>
