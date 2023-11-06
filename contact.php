<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Database connection details
$servername = "localhost";
$dbname = "contact-db";
$tablename = "contact_table";
$username = "worthysvue";
$password = "AVril1102_";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
$sql = "INSERT INTO $tablename (name, email, subject, message, url_link) VALUES ('$name', '$email', '$subject', '$message', '{$_SERVER['HTTP_REFERER']}')";

if ($conn->query($sql) === TRUE) {
    // Send email notification
    $to = "worthysvue@gmail.com";
    $subject = "New Contact Form Submission";
    $emailMessage = "Name: $name\n";
    $emailMessage .= "Email: $email\n";
    $emailMessage .= "Subject: $subject\n";
    $emailMessage .= "Message: $message\n";
    $headers = "From: $email";

    mail($to, $subject, $emailMessage, $headers);

    echo "Thank you! Your message has been sent.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
