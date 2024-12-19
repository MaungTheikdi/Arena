<?php  
function uploadImage($file) {  
    $targetDirectory = "event_photos/";  
    
    // Create directory if it doesn't exist  
    if (!file_exists($targetDirectory)) {  
        mkdir($targetDirectory, 0777, true);  
    }  

    // Generate unique filename  
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));  
    $uniqueFileName = uniqid() . '.' . $fileExtension;  
    $targetFilePath = $targetDirectory . $uniqueFileName;  

    // Allowed file types  
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];  

    // Validate file  
    if (in_array($fileExtension, $allowedTypes)) {  
        // Check file size (limit to 5MB)  
        if ($file['size'] <= 5 * 1024 * 1024) {  
            // Upload file  
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {  
                return $targetFilePath;  
            } else {  
                return false;  
            }  
        } else {  
            return false;  
        }  
    } else {  
        return false;  
    }  
}