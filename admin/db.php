<<<<<<< HEAD
<?php
// Database connection  
$servername = "localhost";  
$username = "root";   
$password = "";  
$dbname = "theikdimaung_arena";  
=======
<?php  
$host = 'localhost';  
$user = 'root';  
$password = '';  
$database = 'theikdimaung_arena';  
>>>>>>> 1e7563d72418419f0ea47eeb7d9f2cee7efe0aad

$conn = new mysqli($servername, $username, $password, $dbname);  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  
<<<<<<< HEAD
// Set charset to UTF-8
if (!$conn->set_charset("utf8")) {
    die("Error loading character set utf8: " . $conn->error);
} 
=======
>>>>>>> 1e7563d72418419f0ea47eeb7d9f2cee7efe0aad
?>
