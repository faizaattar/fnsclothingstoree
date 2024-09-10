<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fns_clothing_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prevent SQL injection by escaping special characters
$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);
$message = $conn->real_escape_string($message);

// Insert data into the database
$sql = "INSERT INTO contact_us (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "<h1>Thank you, $name!</h1>";
    echo "<p>Your message has been received. We will get back to you at <strong>$email</strong> as soon as possible.</p>";
    echo "<a href='contact.html'>Go back to Contact Us page</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
