<?php
// For Mobile and API
$host = 'localhost';
$user = 'theikdimaung_arena_user';
$pass = 'N0OWN70wu33x';
$db = 'theikdimaung_arena';

// Create a new connection to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection was successful
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}
?>