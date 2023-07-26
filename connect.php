<?php
// Retrieve the form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$nic = $_POST['nic'];
$birthday = $_POST['birthday'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$bmi = $_POST['bmi'];
$email = $_POST['email'];
$password = $_POST['password'];
$number = $_POST['number'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'Registration');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed: " . $conn->connect_error);
} else {
    // Prepare and bind the insert query for registration table
    $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, nic, birthday, age, gender, bmi, email, password, number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $firstName, $lastName, $nic, $birthday, $age, $gender, $bmi, $email, $password, $number);

    // Execute the query
    $execval = $stmt->execute();

    // Close the statement
    $stmt->close();

    if ($execval) {
        // Prepare and bind the insert query for users table
        $usersStmt = $conn->prepare("INSERT INTO users (email, password) SELECT email, password FROM registration WHERE email = ?");
        $usersStmt->bind_param("s", $email);

        // Execute the query
        $usersExecval = $usersStmt->execute();

        // Close the statement
        $usersStmt->close();

        // Close the database connection
        $conn->close();

        if ($usersExecval) {
            header("Location: ok.html?registration=success");
            exit();
        } else {
            header("Location: about.html?registration=error");
            exit();
        }
    } else {
        $conn->close();
        header("Location: about.html?registration=error");
        exit();
    }
}
?>
