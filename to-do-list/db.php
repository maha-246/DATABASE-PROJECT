<?php
$host = 'localhost'; // your host name, usually 'localhost'
$db   = 'to-do-list';  // your database name
$user = 'root';      // your user name
$password = '';          // your password

$conn = new mysqli($host, $user, $password, $db);

// Check the connection status
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connection successful
echo "Connected to the database successfully!";
?>
