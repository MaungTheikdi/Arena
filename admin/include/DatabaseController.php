<?php

class DatabaseController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getUser($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header('Location: 404.php');
        }
    }
    // get all users
    public function getAllUsers()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM users");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header('Location: 404.php');
        }
    }

    public function getLastestReservations()
    {
        $stmt = $this->db->prepare("SELECT 
                                    u.name,
                                    t.table_name,
                                    p.description,
                                    r.reservation_date,
                                    r.sitting
                                    FROM `reservations` r
                                    LEFT JOIN users u ON u.user_id = r.user_id
                                    LEFT JOIN tables t ON t.table_id = r.table_id
                                    LEFT JOIN packages p ON p.package_id = r.package_id
                                    ORDER BY r.reservation_id DESC
                                    LIMIT 10");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // get all reservations
    public function getAllReservations()
    {
        $stmt = $this->db->query("SELECT 
                                    u.name,
                                    r.user_id,
                                    t.table_name,
                                    p.description,
                                    r.reservation_date,
                                    r.sitting
                                    FROM `reservations` r
                                    LEFT JOIN users u ON u.user_id = r.user_id
                                    LEFT JOIN tables t ON t.table_id = r.table_id
                                    LEFT JOIN packages p ON p.package_id = r.package_id
                                    ORDER BY r.reservation_id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // get a reservation with user_id
    public function getReservationByUserId($user_id)
    {
        $stmt = $this->db->prepare("SELECT 
                                    u.name,
                                    r.user_id,
                                    t.table_name,
                                    p.description,
                                    r.reservation_date,
                                    r.sitting
                                    FROM `reservations` r
                                    LEFT JOIN users u ON u.user_id = r.user_id
                                    LEFT JOIN tables t ON t.table_id = r.table_id
                                    LEFT JOIN packages p ON p.package_id = r.package_id
                                    WHERE r.user_id = :user_id
                                    ORDER BY r.reservation_id DESC");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // get Events
    public function getEvents()
    {
        $stmt = $this->db->prepare("SELECT * FROM arena_events ORDER BY event_date DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // get all transactions
    public function getAllTransactions()
    {
        $stmt = $this->db->query("SELECT 
                                    ts.transaction_id,
                                    ts.transaction_date,
                                    ts.amount,
                                    ts.transaction_type,
                                    u.name,
                                    r.reservation_date,
                                    t.table_name
                                    FROM `transactions` ts
                                    LEFT JOIN users u ON u.user_id = ts.user_id
                                    LEFT JOIN reservations r ON r.reservation_id = ts.reservation_id
                                    LEFT JOIN tables t ON t.table_id = r.table_id
                                    ORDER BY transaction_id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // get all tables
    public function getAllTables()
    {
        $stmt = $this->db->query("SELECT 
                                    t.table_id,
                                    tt.name,
                                    t.table_name,
                                    t.status
                                    FROM `tables` t
                                    LEFT JOIN table_types tt ON tt.table_type_id = t.table_type_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // get all table types
    public function getAllPackages()
    {
        $stmt = $this->db->query("SELECT 
                                    p.package_id,
                                    tt.name as table_type,
                                    p.description as package,
                                    p.price
                                    FROM `packages` p 
                                    LEFT JOIN table_types tt ON tt.table_type_id = p.table_type_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // delete event with event_id
    public function deleteEvent($event_id){
        try {
            $stmt = $this->db->prepare("DELETE FROM arena_events WHERE event_id = :event_id");
            $stmt->bindParam(':event_id', $event_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}

?>