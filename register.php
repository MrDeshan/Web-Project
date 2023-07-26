<?php
// Database connection settings
$host = 'localhost';
$dbName = 'gym_database';
$username = 'root';
$password = '';

// Create a new PDO instance
try {
  $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die('Connection failed: ' . $e->getMessage());
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$membership = $_POST['membership'];
$interests = isset($_POST['interests']) ? $_POST['interests'] : [];

// Insert data into the database
try {
  $stmt = $db->prepare("INSERT INTO members (name, email, phone, gender, membership, interests) VALUES (:name, :email, :phone, :gender, :membership, :interests)");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':phone', $phone);
  $stmt->bindParam(':gender', $gender);
  $stmt->bindParam(':membership', $membership);
  $stmt->bindParam(':interests', implode(',', $interests));
  $stmt->execute();
  
  // Success message
  echo "Registration successful!";
} catch(PDOException $e) {
  // Error message
  echo "Error: " . $e->getMessage();
}

// Close the database connection
$db = null;
?>
