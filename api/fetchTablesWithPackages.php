<?php

header("Content-Type: application/json; charset=UTF-8");
require 'db_pdo.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $selectedDate = isset($_GET['date']) ? $_GET['date'] : null;

    if (!$selectedDate) {
        echo json_encode(["error" => "Date is required"]);
        exit;
    }

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL Query to fetch tables with their status and package details
        $query = "SELECT 
                t.table_id,
                t.table_name,
                tt.name AS table_type,
                CASE
                    WHEN EXISTS (
                        SELECT 1 
                        FROM reservations r
                        WHERE r.table_id = t.table_id
                        AND DATE(r.reservation_date) = :selectedDate
                    )
                    THEN 'Reserved'
                    ELSE 'Available'
                END AS table_status,
                p.package_id,
                p.description AS package_description,
                p.price AS package_price
            FROM tables t            
            INNER JOIN table_types tt ON t.table_type_id = tt.table_type_id
            LEFT JOIN packages p ON tt.table_type_id = p.table_type_id
            WHERE t.status = 'ON'
            ORDER BY t.table_id, p.package_id;
        ";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
        $stmt->execute();

        $tables = [];
        $currentTableId = null;
        $currentTable = null;

        // Fetch results and structure data
        while ($row = $stmt->fetch()) {
            if ($currentTableId !== $row['table_id']) {
                // Push the current table and reset for a new table
                if ($currentTable) {
                    $tables[] = $currentTable;
                }

                $currentTable = [
                    "table_id" => $row['table_id'],
                    "table_name" => $row['table_name'],
                    "table_type" => $row['table_type'],
                    "table_status" => $row['table_status'],
                    "packages" => []
                ];
                $currentTableId = $row['table_id'];
            }

            // Add package details if available
            if ($row['package_id']) {
                $currentTable["packages"][] = [
                    "package_id" => $row['package_id'],
                    "description" => $row['package_description'],
                    "price" => $row['package_price']
                ];
            }
        }

        // Push the last table
        if ($currentTable) {
            $tables[] = $currentTable;
        }


        // Push the last table
        //if ($currentTable) {
        //    $tables[] = $currentTable;
        //}

        //header('Content-Type: application/json');
        echo json_encode($tables);
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Invalid request method. Use GET."]);
}

?>