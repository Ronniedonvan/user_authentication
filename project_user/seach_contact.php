<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $registration_number = $_GET['registration_number'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'contactApp');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Search for contact
    $sql = "SELECT * FROM contacts WHERE registration_number='$registration_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $contact = $result->fetch_assoc();
        echo "Contact Details:<br>";
        echo "Mobile: " . $contact['mobile'] . "<br>";
        echo "Email: " . $contact['email'] . "<br>";
        echo "Address: " . $contact['address'] . "<br>";
        echo "Registration Number: " . $contact['registration_number'] . "<br>";
    } else {
        echo "No contact found with that registration number.";
    }

    $conn->close();
}
?>
