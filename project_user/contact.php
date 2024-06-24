<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contact-form-container">
        <h2>Contact Form</h2>
        <form action="save_contact.php" method="post">
            <input type="text" name="mobile" placeholder="Mobile Phone Number" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="text" name="registration_number" placeholder="Registration Number" required>
            <button type="submit">Save Contact</button>
        </form>
    </div>
</body>
</html>
