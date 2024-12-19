<?php  
session_start();  
header('Content-Type: application/json');  

$response = ['success' => false, 'message' => 'Invalid CAPTCHA.'];  

// Validate CAPTCHA  
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['captcha'])) {  
    $captcha_input = trim($_POST['captcha']);  
    
    if (isset($_SESSION['captcha']) && $_SESSION['captcha'] == $captcha_input) {  
        $response['success'] = true;  
        $response['message'] = 'CAPTCHA validated successfully.';  
    } else {  
        $response['message'] = 'CAPTCHA does not match.';  
    }  
}  

echo json_encode($response);  
?>