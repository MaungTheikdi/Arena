<?php  
$host = 'localhost';  
$user = 'theikdimaung_arena_user';  
$password = 'N0OWN70wu33x';  
$database = 'theikdimaung_arena';  

$conn = new mysqli($host, $user, $password, $database);  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  
?>