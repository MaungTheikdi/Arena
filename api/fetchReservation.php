<?php
include 'db.php';

// Get user_id from the URL parameter
$user_id = $_GET['user_id'];

$sql = "SELECT * FROM `reservations` WHERE user_id = ? AND DATE(`reservation_date`) = CURDATE() AND sitting = 'No' ;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
 
$user = array();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($user);
?>
