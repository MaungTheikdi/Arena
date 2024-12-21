
<?php 
include_once 'include/header.php'; 
?>

<?php  
include 'db.php';  
include 'upload_event.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $name = $_POST['name'];  
    $description = $_POST['description'];  
    $event_date = $_POST['event_date'];  
    $price = $_POST['price'];  
    $status = $_POST['status'];  

    // Handle image upload  
    $image_url = ''; // Default empty  
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {  
        $uploadedImagePath = uploadImage($_FILES['event_image']);  
        if ($uploadedImagePath) {  
            $image_url = $uploadedImagePath;  
        }  
    }  

    $sql = "INSERT INTO arena_events   
            (name, description, event_date, price, status, image_url)   
            VALUES (?, ?, ?, ?, ?, ?)";  
    
    $stmt = $conn->prepare($sql);  
    $stmt->bind_param("sssdss", $name, $description, $event_date, $price, $status, $image_url);  
    
    if ($stmt->execute()) {  
        header('Location: events_list.php');  
        exit();  
    } else {  
        $error = "Error creating event: " . $stmt->error;  
    }  
}  
?>  

        <div id="layoutSidenav_content">

            <main>
                                
                <div class="container">  
                    <h2>Create New Event</h2>  
                    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>  
                    <form method="POST" enctype="multipart/form-data">  
                        <div class="mb-3">  
                            <label for="name" class="form-label">Event Name</label>  
                            <input type="text" class="form-control" name="name" required>  
                        </div>  
                        <div class="mb-3">  
                            <label for="description" class="form-label">Description</label>  
                            <textarea class="form-control" name="description" rows="3"></textarea>  
                        </div>  
                        <div class="mb-3">  
                            <label for="event_date" class="form-label">Event Date</label>  
                            <input type="datetime-local" class="form-control" name="event_date" required>  
                        </div>  
                        <div class="mb-3">  
                            <label for="price" class="form-label">Price</label>  
                            <input type="number" class="form-control" name="price" step="0.01" min="0">  
                        </div>  
                        <div class="mb-3">  
                            <label for="status" class="form-label">Status</label>  
                            <select class="form-control" name="status">  
                                <option value="Upcoming">Upcoming</option>  
                                <option value="Ongoing">Ongoing</option>  
                                <option value="Completed">Completed</option>  
                                <option value="Canceled">Canceled</option>  
                            </select>  
                        </div>  
                        <div class="mb-3">  
                            <label for="event_image" class="form-label">Event Image</label>  
                            <input type="file" class="form-control" name="event_image" accept="image/*">  
                        </div>  
                        <button type="submit" class="btn btn-primary">Create Event</button>  
                        <a href="index.php" class="btn btn-secondary">Cancel</a>  
                    </form>  
                </div>
            </main>
            
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Arena 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    
    <?php include 'include/script.php'; ?>
    <script>
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });
    </script>
</body>

</html>

