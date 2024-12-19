<?php  
header('Content-Type: application/json');  
require_once 'db.php';

$data = json_decode(file_get_contents("php://input"));  

$transaction_id = $data->transaction_id;
$user_id = $data->user_id;
$reservation_id = $data->reservation_id;
$transaction_date = $data->transaction_date;
$amount = $data->amount;
$transaction_type = $data->transaction_type;


// Begin transaction  
$conn->begin_transaction();  

try {      
    // Check if user has sufficient balance
    $stmt = $conn->prepare("SELECT wallet_balance FROM users WHERE user_id =?");  
    $stmt->bind_param("i", $user_id);  
    $stmt->execute();  
    $result = $stmt->get_result();  
    $row = $result->fetch_assoc();
    $wallet_balance = $row['wallet_balance'];
    if ($wallet_balance < $amount) {
        throw new Exception("Insufficient balance in wallet.");
    }
    // Insert into transactions table  
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, amount, transaction_type) VALUES (?, ?, 'Payment')");  
    $stmt->bind_param("ii", $user_id,  $amount);  
    $stmt->execute();  

    // Update user's wallet balance  
    $stmt = $conn->prepare("UPDATE users SET wallet_balance = wallet_balance - ? WHERE user_id = ?");  
    $stmt->bind_param("ii", $amount, $user_id);  
    $stmt->execute();  

    $conn->commit();  
    echo json_encode(["success" => true, "message" => "Payment made successfully."]);  
} catch (Exception $e) {  
    $conn->rollback();  
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);  
}  

$stmt->close();  
$conn->close();  
?>