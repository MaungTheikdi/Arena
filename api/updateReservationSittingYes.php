<?php
header("Content-Type: application/json");
require 'db.php'; // Replace with your DB connection file

if (isset($_POST['user_id']) && isset($_POST['reservation_id'])) {
    $user_id = intval($_POST['user_id']);
    $reservation_id = $_POST['reservation_id'];

    // Validate user ID and reservation id
    $userQuery = "SELECT * FROM reservations WHERE user_id = ? AND reservation_id = ?";
    $stmt = $conn->prepare($userQuery);
    $stmt->bind_param("ii", $user_id, $reservation_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update reservation
        $updateWalletQuery = " UPDATE reservations SET sitting = 'Yes' WHERE reservation_id = ? ";
        $stmt = $conn->prepare($updateWalletQuery);
        $stmt->bind_param("i",  $reservation_id);
        $stmt->execute();

        echo json_encode(["status" => "success", "message" => "Sutting to Yes"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid user ID or card number"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Missing parameters"]);
}
?>
