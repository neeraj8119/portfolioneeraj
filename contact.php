<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portfolio_db";
    $port = 4306; // change this if your MySQL runs on 4306

    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    if ($conn->connect_error) {
        die("<script>alert('Database connection failed: " . $conn->connect_error . "');window.location='index.html';</script>");
    }

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("<script>alert('Database error: cannot prepare statement');window.location='index.html';</script>");
    }

    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message saved successfully!');window.location='index.html';</script>";
    } else {
        echo "<script>alert('Error saving message.');window.location='index.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
