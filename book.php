<?php
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "groupTask"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $time = $_POST['time'];
    $people = $_POST['people'];
    $message = $_POST['message'];

    $sql = "INSERT INTO bookings (name, email, phone, category, time, people, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiss", $name, $email, $phone, $category, $time, $people, $message);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        if ($conn->errno == 1062) {
            echo "Error: Duplicate email. Please use a different email address.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>
