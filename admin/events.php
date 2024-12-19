<?php  
include 'db.php';  

// Fetch events  
$sql = "SELECT * FROM arena_events ORDER BY event_date DESC";  
$result = $conn->query($sql);  
?>  
<div class="mb-3">  
    <a href="create_event.php" class="btn btn-primary">Add Event</a>  
</div>  
<table class="table table-bordered">  
    <thead>  
        <tr>  
            <th>IMG</th>
            <th>ID</th>  
            <th>Name</th>  
            <th>Description</th>  
            <th>Event Date</th>  
            <th>Price</th>  
            <th>Status</th>  
            <th>Actions</th>  
        </tr>  
    </thead>  
    <tbody>  
        <?php while ($row = $result->fetch_assoc()) { ?>  
            <tr>  
                <td><img src="<?= $row['image_url'] ?>" width="60px"></td>
                <td><?= $row['id'] ?></td>  
                <td><?= $row['name'] ?></td>  
                <td><?= $row['description'] ?></td>  
                <td><?= $row['event_date'] ?></td>  
                <td><?= $row['price'] ?></td>  
                <td><?= $row['status'] ?></td>  
                <td>  
                    <a href="edit_event.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>  
                    <a href="delete_event.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>  
                </td>  
            </tr>  
        <?php } ?>  
    </tbody>  
</table>