<?php
session_start(); // Start the session to track user data
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'digital_literacy';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Database connection failed: ' . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into the database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Store the username in the session to track the logged-in user
        $_SESSION['user_name'] = $name;  // Set the session variable with the username

        // Respond with success and user name
        echo json_encode(['success' => true, 'name' => $name]);

        // Optionally, you can redirect to a new page after successful signup (e.g., index.html)
        header("Location: index2.php");
        exit;  // Ensure that no further code is executed after redirection
    } else {
        // If there is an error inserting into the database, return an error response
        echo json_encode(['success' => false, 'error' => 'Error: ' . $sql . ' ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
?>
