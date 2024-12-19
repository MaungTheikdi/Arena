<?php  
include 'db.php';  
include 'upload_event.php';  

// Check if ID is provided  
if (!isset($_GET['id'])) {  
    header('Location: index.php');  
    exit();  
}  

$id = $_GET['id'];  

// Fetch existing event data  
$sql = "SELECT * FROM arena_events WHERE id = ?";  
$stmt = $conn->prepare($sql);  
$stmt->bind_param("i", $id);  
$stmt->execute();  
$result = $stmt->get_result();  
$event = $result->fetch_assoc();  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $name = $_POST['name'];  
    $description = $_POST['description'];  
    $event_date = $_POST['event_date'];  
    $price = $_POST['price'];  
    $status = $_POST['status'];  

    // Handle image upload  
    $image_url = $event['image_url']; // Keep existing image by default  
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {  
        $uploadedImagePath = uploadImage($_FILES['event_image']);  
        if ($uploadedImagePath) {  
            $image_url = $uploadedImagePath;  
            
            // Delete old image if exists  
            if (!empty($event['image_url']) && file_exists($event['image_url'])) {  
                unlink($event['image_url']);  
            }  
        }  
    }  

    // Update SQL with prepared statement  
    $sql = "UPDATE arena_events   
            SET name = ?, description = ?, event_date = ?,   
                price = ?, status = ?, image_url = ?  
            WHERE id = ?";  
    
    $stmt = $conn->prepare($sql);  
    $stmt->bind_param("sssdssi", $name, $description, $event_date,   
                      $price, $status, $image_url, $id);  
    
    if ($stmt->execute()) {  
        header('Location: index.php');  
        exit();  
    } else {  
        $error = "Error updating event: " . $stmt->error;  
    }  
}  
?>  

<!DOCTYPE html>  
<html>  
<head>  
    <title>Edit Event</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">  
</head>  
<body>  
<div class="container mt-5">  
    <h2>Edit Event</h2>  
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>  
    <form method="POST" enctype="multipart/form-data">  
        <div class="mb-3">  
            <label for="name" class="form-label">Event Name</label>  
            <input type="text" class="form-control" name="name"   
                   value="<?= htmlspecialchars($event['name']) ?>" required>  
        </div>  
        <div class="mb-3">  
            <label for="description" class="form-label">Description</label>  
            <textarea class="form-control" name="description" rows="3">  
                <?= htmlspecialchars($event['description']) ?>  
            </textarea>  
        </div>  
        <div class="mb-3">  
            <label for="event_date" class="form-label">Event Date</label>  
            <input type="datetime-local" class="form-control" name="event_date"   
                   value="<?= date('Y-m-d\TH:i', strtotime($event['event_date'])) ?>" required>  
        </div>  
        <div class="mb-3">  
            <label for="price" class="form-label">Price</label>  
            <input type="number" class="form-control" name="price"   
                   value="<?= $event['price'] ?>" step="0.01" min="0">  
        </div>  
        <div class="mb-3">  
            <label for="status" class="form-label">Status</label>  
            <select class="form-control" name="status">  
                <option value="Upcoming" <?= $event['status'] == 'Upcoming' ? 'selected' : '' ?>>Upcoming</option>  
                <option value="Ongoing" <?= $event['status'] == 'Ongoing' ? 'selected' : '' ?>>Ongoing</option>  
                <option value="Completed" <?= $event['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>  
                <option value="Canceled" <?= $event['status'] == 'Canceled' ? 'selected' : '' ?>>Canceled</option>  
            </select>  
        </div>  
        <div class="mb-3">  
            <label for="event_image" class="form-label">Event Image</label>  
            <input type="file" class="form-control" name="event_image" accept="image/*">  
            <?php if (!empty($event['image_url'])): ?>  
                <div class="mt-2">  
                    <p>Current Image:</p>  
                    <img src="<?= htmlspecialchars($event['image_url']) ?>"   
                         alt="Event Image" style="max-width: 200px; max-height: 200px;">  
                </div>  
            <?php endif; ?>  
        </div>  
        <button type="submit" class="btn btn-primary">Update Event</button>  
        <a href="index.php" class="btn btn-secondary">Cancel</a>  
    </form>  
</div>  
</body>  
</html>