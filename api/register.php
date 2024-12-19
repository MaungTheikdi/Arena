<?php
header('Content-Type: application/json');

include 'db.php';
date_default_timezone_set('Asia/Yangon');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {  
        echo json_encode(['success' => false, 'message' => 'Invalid name format.']);  
        exit;  
    }  

    if (!preg_match("/^[0-9]{8,12}$/", $phone)) {  
        echo json_encode(['success' => false, 'message' => 'Invalid phone number format.']);  
        exit;  
    }  

    $card_number = "3653".date("ymdHis");
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (name, phone, password_hash, card_number) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $phone, $password, $card_number);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Registration successful.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registration failed: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
    exit;
}
echo json_encode(['success' => false, 'message' => 'Invalid request.']);

?>
