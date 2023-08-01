<?php
// Retrieve the form data
$email = $_POST['email'];
$userPassword = $_POST['password'];

// Connect to the database
$servername = "localhost";
$username = "root";
$dbPassword = "";
$dbname = "Registration";

$conn = new mysqli($servername, $username, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$userPassword'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // User credentials are correct, perform login actions
    // For example, redirect to a dashboard page
    header("Location: dashboard.php");
    exit();
} else {
    // User credentials are incorrect, display an error message
    header ("Location: error.html");
}

$conn->close();
header("Location: error.html");
        exit();
    
?>
