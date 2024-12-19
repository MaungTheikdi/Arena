<?php
header("Content-Type: application/json");
require 'db.php'; // Replace with your DB connection file

if (isset($_POST['user_id']) && isset($_POST['card_number']) && isset($_POST['amount'])) {
    $user_id = intval($_POST['user_id']);
    $card_number = $_POST['card_number'];
    $amount = floatval($_POST['amount']);

    // Validate user ID and card number
    $userQuery = "SELECT * FROM users WHERE user_id = ? AND card_number = ?";
    $stmt = $conn->prepare($userQuery);
    $stmt->bind_param("is", $user_id, $card_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Add transaction
        $transactionQuery = "
            INSERT INTO transactions (user_id, amount, transaction_type, transaction_date)
            VALUES (?, ?, 'Add Fund', NOW())
        ";
        $stmt = $conn->prepare($transactionQuery);
        $stmt->bind_param("id", $user_id, $amount);
        $stmt->execute();

        // Update wallet balance
        $updateWalletQuery = "
            UPDATE users SET wallet_balance = wallet_balance + ? WHERE user_id = ?
        ";
        $stmt = $conn->prepare($updateWalletQuery);
        $stmt->bind_param("di", $amount, $user_id);
        $stmt->execute();

        echo json_encode(["status" => "success", "message" => "Funds added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid user ID or card number"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Missing parameters"]);
}
?>
