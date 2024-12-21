<?php  
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    // Get the user data from the form  
    $user_id = $_POST['user_id'];  
    $name = $_POST['name'];  
    $phone = $_POST['phone'];  
    $card_number = $_POST['card_number'];  
    $member_type = $_POST['member_type'];  
    $wallet_balance = $_POST['wallet_balance'];  

    // Validate the input data (optional, but recommended)  
    $name = trim($name);  
    $phone = trim($phone);  
    $card_number = trim($card_number);  
    $member_type = trim($member_type);  
    $wallet_balance = trim($wallet_balance);  

    $sql = "UPDATE users SET   
                name = ?,   
                phone = ?,   
                card_number = ?,   
                member_type = ?,   
                wallet_balance = ?   
            WHERE user_id = ?";  

    if ($stmt = $conn->prepare($sql)) {  
        $stmt->bind_param("ssssii", $name, $phone, $card_number, $member_type, $wallet_balance, $user_id);  

        if ($stmt->execute()) {  
            header("Location: users.php?edit_success=1"); // Redirect to the user list page with a success flag  
            exit;  
        } else {  
            echo "Error updating record: " . $stmt->error;  
        }   
        $stmt->close();  
    } else {  
        echo "Error preparing statement: " . $conn->error;  
    }  
    $conn->close();  
} else {  
    header("Location: users.php");  
    exit;  
}  
?>