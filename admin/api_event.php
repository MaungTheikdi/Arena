<?php  
header("Content-Type: application/json");  
header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");  
header("Access-Control-Allow-Headers: Content-Type");  

include 'db.php';  

// GET Events  
function getEvents() {  
    global $conn;  
    $sql = "SELECT * FROM arena_events ORDER BY event_date DESC";  
    $result = $conn->query($sql);  
    $events = [];  
    
    while ($row = $result->fetch_assoc()) {  
        $events[] = $row;  
    }  
    
    echo json_encode($events);  
}  

// POST Event  
function createEvent() {  
    global $conn;  
    $data = json_decode(file_get_contents("php://input"), true);  
    
    $name = $data['name'];  
    $description = $data['description'];  
    $event_date = $data['event_date'];  
    $price = $data['price'];  
    $status = $data['status'];  
    $image_url = $data['image_url'];  
    
    $sql = "INSERT INTO arena_events   
            (name, description, event_date, price, status, image_url)   
            VALUES (?, ?, ?, ?, ?, ?)";  
    
    $stmt = $conn->prepare($sql);  
    $stmt->bind_param("sssdss", $name, $description, $event_date, $price, $status, $image_url);  
    
    if ($stmt->execute()) {  
        echo json_encode(["success" => true, "message" => "Event created"]);  
    } else {  
        echo json_encode(["success" => false, "message" => "Error creating event"]);  
    }  
}  

// Handle Request  
$method = $_SERVER['REQUEST_METHOD'];  
switch ($method) {  
    case 'GET':  
        getEvents();  
        break;  
    case 'POST':  
        createEvent();  
        break;  
}  
?>