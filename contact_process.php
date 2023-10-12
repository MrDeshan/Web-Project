<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $to = "deshan.t.dissanayaka@gmail.com"; 
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        echo "Your message has been sent successfully!";
    } else {
        echo "Failed to send the message. Please try again later.";
    }
} else {
    echo "Invalid request. Please submit the form.";
}
?>
