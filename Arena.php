<?php
class Arena {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }
    // getUser function  
    public function getUser($id){
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header('Location: 404.php');
        }
    }
    
    // getReservations function
    public function getUserReservations($user_id){
        try {
            $stmt = $this->db->prepare("SELECT * FROM reservations WHERE user_id = :user_id AND DATE(`reservation_date`) = CURDATE() AND sitting = 'No'");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header('Location: 404.php');
            exit();
        }
    }

    // get Tables for reservations
    public function getTables($selectedDate){
        try {
            $stmt = $this->db->prepare("SELECT   
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
                                        GROUP_CONCAT(p.package_id) AS package_ids,  
                                        GROUP_CONCAT(p.description) AS package_descriptions,  
                                        GROUP_CONCAT(p.price) AS package_prices  
                                    FROM tables t            
                                    INNER JOIN table_types tt ON t.table_type_id = tt.table_type_id  
                                    LEFT JOIN packages p ON tt.table_type_id = p.table_type_id  
                                    WHERE t.status = 'ON'  
                                    GROUP BY t.table_id, t.table_name, tt.name  
                                    ORDER BY t.table_id;");
            $stmt->bindParam(':selectedDate', $selectedDate);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header('Location: 404.php');
        }
    }

    // getPackages function
    public function getTablePackages($table_id){
        try {
            $stmt = $this->db->prepare("SELECT 
                t.table_id,
                t.table_name,
                tt.name AS table_type,
                p.package_id,
                p.description
            FROM tables t            
            INNER JOIN table_types tt ON t.table_type_id = tt.table_type_id
            LEFT JOIN packages p ON tt.table_type_id = p.table_type_id
            WHERE t.table_id = :tableId AND t.status = 'ON'
            ORDER BY t.table_id, p.package_id");
            $stmt->bindParam(':tableId', $table_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header('Location: 404.php');
        }
    }

    // fetch all users transactions
    /*
     ?
        */
    // fetch user's transactions
    public function getUserTransactions($user_id){
        try{
            $stmt = $this->db->prepare("SELECT
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
                                        WHERE ts.user_id = :userId
                                        ORDER BY ts.transaction_id DESC
                                        ");
            $stmt->bindParam(':userId', $user_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            header('Location: 404.php');
        }
    }

    // getTransaction with transaction_id
    public function getTransaction($transaction_id, $user_id){
        try {
            $stmt = $this->db->prepare("SELECT * FROM transactions WHERE transaction_id = :transaction_id AND user_id = :user_id ");
            $stmt->bindParam(':transaction_id', $transaction_id);  
            $stmt->bindParam(':user_id', $user_id); 
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header('Location: 404.php');
        }
    }

    // getReservationByID
    public function getReservationById($reservation_id){
        try {
            $stmt = $this->db->prepare("SELECT 
                                        t.table_name,
                                        p.description
                                        FROM `reservations` r
                                        LEFT JOIN tables t ON t.table_id = r.table_id
                                        LEFT JOIN packages p ON p.package_id = r.package_id
                                        WHERE r.reservation_id = :reservation_id");
            $stmt->bindParam(':reservation_id', $reservation_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header('Location: 404.php');
        }
    }

    // getEvents function
    public function getEvents(){
        try {
            $stmt = $this->db->prepare("SELECT * FROM arena_events ORDER BY event_date DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header('Location: 404.php');
        }
    }


    
}

?>