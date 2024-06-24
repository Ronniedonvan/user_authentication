<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $token = $_GET['token'];
    $sql = "SELECT * FROM users WHERE reset_token='$token' AND token_expiry > NOW()";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Token is valid, show reset password form
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="reset_password.php" method="POST">
            <input type="hidden" name="token" value="'.$token.'">
            <input type="password" name="password" placeholder="Enter new password" required>
            <button type="submit">Submit</button>
        </form>
        <p id="message"></p>
    </div>
</body>
</html>';
    } else {
        echo "Invalid or expired token.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password='$password', reset_token=NULL, token_expiry=NULL WHERE reset_token='$token'";
    if (mysqli_query($conn, $sql)) {
        echo "Password has been reset successfully.";
    } else {
        echo "Failed to reset password.";
    }
}
?>
