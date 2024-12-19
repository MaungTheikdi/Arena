<?php

header("Content-Type: application/json");

require 'db.php';

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    $query = "
        SELECT
            ts.transaction_id,
            ts.transaction_date,
            ts.amount,
            ts.transaction_type,
            r.reservation_date,
            t.table_name,
            tt.name AS table_type,
            p.description AS package_description
        FROM
            transactions ts
        LEFT JOIN reservations r ON r.reservation_id = ts.reservation_id
        LEFT JOIN tables t ON t.table_id = r.table_id
        LEFT JOIN packages p ON p.package_id = r.package_id
        LEFT JOIN table_types tt ON tt.table_type_id = t.table_type_id
        WHERE ts.user_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $transactions = [];
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }

    echo json_encode($transactions);
} else {
    echo json_encode(["error" => "User ID not provided"]);
}
?>
