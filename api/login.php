<?php
session_start();
header('Content-Type: application/json');
// Include the database connection
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    // Fetch the user with the given phone
    $stmt = $conn->prepare("SELECT user_id, name, password_hash FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $hashedPassword);
        $stmt->fetch();
        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Store user information in session  
            $_SESSION['user_id'] = $id;  
            $_SESSION['name'] = $name;  

            echo json_encode(['success' => true, 'message' => 'Login successful.', 'user_id' => $id, 'name' => $name]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found.']);
    }
    $stmt->close();
    $conn->close();
    exit;
}
// Invalid request
echo json_encode(['success' => false, 'message' => 'Invalid request.']);
?>
