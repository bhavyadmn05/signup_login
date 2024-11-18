<?php
session_start();

// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'digital_literacy';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $entered_password = htmlspecialchars($_POST['password'], ENT_QUOTES);

    $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stored_hash = $user['password'];

        if (password_verify($entered_password, $stored_hash)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index2.php");
        } else {
            header("Location: login.php?error=Invalid email or password.");
        }
    } else {
        header("Location: login.php?error=No user found with that email address.");
    }
    $conn->close();
}
?>
