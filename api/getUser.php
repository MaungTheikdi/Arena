<?php
include 'db.php';

// Get user_id from the URL parameter
$user_id = $_GET['user_id'];

$sql = "SELECT 
            user_id, 
            name, 
            phone, 
            card_number AS cardNumber, 
            member_type AS membershipType, 
            wallet_balance AS walletBalance,
            created_date AS createdDate
        FROM users WHERE user_id = ?";

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
