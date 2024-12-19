<?php
// For Web Users
$servername = "localhost";
$username = "theikdimaung_arena_user";
$password = "N0OWN70wu33x";
$database = "theikdimaung_arena";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>