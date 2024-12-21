<?php
// Database connection  
$servername = "localhost";  
$username = "root";   
$password = "";  
$dbname = "theikdimaung_arena";  

$conn = new mysqli($servername, $username, $password, $dbname);  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  
// Set charset to UTF-8
if (!$conn->set_charset("utf8")) {
    die("Error loading character set utf8: " . $conn->error);
} 
?>
