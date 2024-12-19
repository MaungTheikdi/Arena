<?php  
header('Content-Type: application/json');  
require_once 'db.php';
$data = json_decode(file_get_contents("php://input"));  

$userId = $data->userId;  
$tableId = $data->tableId;  
$packageId = $data->packageId;  
$reservationDate = $data->reservationDate;  
$amount = $data->amount;  

// Begin transaction  
$conn->begin_transaction();  

try {  
    // Check if user has sufficient balance
    $stmt = $conn->prepare("SELECT wallet_balance FROM users WHERE user_id =?");  
    $stmt->bind_param("i", $userId);  
    $stmt->execute();  
    $result = $stmt->get_result();  
    $row = $result->fetch_assoc();
    $balance = $row['wallet_balance'];
    if ($balance < $amount) {
        throw new Exception("Insufficient balance.");
        
    }
    // Insert into reservations table  
    $stmt = $conn->prepare("INSERT INTO reservations (user_id, table_id, package_id, reservation_date) VALUES (?, ?, ?, ?)");  
    $stmt->bind_param("iiis", $userId, $tableId, $packageId, $reservationDate);  
    $stmt->execute();  
    
    $reservationId = $conn->insert_id;  

    // Insert into transactions table  
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, reservation_id, amount, transaction_type) VALUES (?, ?, ?, 'Reservation')");  
    $stmt->bind_param("iid", $userId, $reservationId, $amount);  
    $stmt->execute();  

    // Update user's wallet balance  
    $stmt = $conn->prepare("UPDATE users SET wallet_balance = wallet_balance - ? WHERE user_id = ?");  
    $stmt->bind_param("di", $amount, $userId);  
    $stmt->execute();  

    $conn->commit();  
    echo json_encode(["success" => true, "message" => "Reservation made successfully."]);  
} catch (Exception $e) {  
    $conn->rollback();  
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);  
}  

$stmt->close();  
$conn->close();  
?>