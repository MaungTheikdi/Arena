<?php include_once 'header.php'; ?>

<?php
include_once('Arena.php');
include_once('ArenaUtil.php');

$arena = new Arena($conn);
$util = new ArenaUtil();

$tableType = $_GET['table_type'];
$tableId = $_GET['table_id'];
$reservationDate = $_GET['date'];
$tableName = $_GET['table_name'];
$amount = $_GET['amount'];

$userId = $_SESSION['user_id'];
$userName = $_SESSION['name'];


// Fetch table and package details
$tablePackages = $arena->getTablePackages($tableId);
$userData = $arena->getUser($userId);
/*
$userId = $data->userId;  
$tableId = $data->tableId;  
$packageId = $data->packageId;  
$reservationDate = $data->reservationDate;  
$amount = $data->amount; 
*/

?>

<body style="background: rgb(242,242,242);">
    <div class="row">
        <div class="col-12">
            <form class="m-3 p-3 rounded-3 border-3" id="submitReservation">
                <h1 id="username"><?= $userName ?></h1>
                <input class="form-control" type="hidden" id="tableId" value="<?= $tableId ?>" >
                <div class="input-group mb-2"><span class="input-group-text"><i class="fas fa-couch"></i></span>
                    <input class="form-control" type="text" id="tableName" value="<?php echo $tableType.' '.$tableName; ?>" readonly="">
                </div>
                <select class="form-select mb-2" id="packageId" required="">
                    <option value="" selected="">Choose Package</option>
                    <?php foreach($tablePackages as $package): ?>
                    <option value="<?= $package['package_id'] ?>"><?= $package['description'] ?></option>
                    <?php endforeach;?>
                </select>
                <div class="d-flex justify-content-between">
                    <div><i class="far fa-calendar-alt me-2"></i><span id="reservationDate"><?php echo $reservationDate; ?></span></div>
                    <div><i class="fas fa-dollar-sign me-2"></i><span id="amount"><?php echo $amount; ?></span></div>
                </div>
            </form>
        </div>
        <div class="col-12 mb-2">  
            <a class="pay-link" href="#" id="paymentSubmit">  
                <div class="d-flex justify-content-between p-3 mx-3 bg-white rounded-4">  
                    <div><img src="assets/img/arena.jpeg" width="60"></div>  
                    <div>  
                        <p class="m-0 float-end">Arena Pay</p>  
                        <p class="m-0">Balance : <span id="walletBalance"><?= $userData['wallet_balance'] ?></span></p>  
                    </div>  
                </div>  
            </a>  
        </div>
        <div class="col-12 mb-2">
            <a class="pay-link" href="#">
                <div class="d-flex justify-content-between p-3 mx-3 bg-white rounded-4">
                    <div><img src="assets/img/kbz.png" width="60"></div>
                    <div>
                        <p class="m-0">KBZ Pay</p>
                        <p class="m-0"></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 mb-2">
            <a class="pay-link" href="#">
                <div class="d-flex justify-content-between p-3 mx-3 bg-white rounded-4">
                    <div><img src="assets/img/wave.png" width="60"></div>
                    <div>
                        <p class="m-0">Wave Pay</p>
                        <p class="m-0"></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 text-align-center">
            <a href="index.php">Go Back Home</a>
        </div>
    </div>
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
<script>  
    $(document).ready(function() {  
        $('#paymentSubmit').on('click', function(e) {  
            e.preventDefault(); // Prevent default anchor click behavior  

            // Gather form data  
            var userId = <?= json_encode($userId); ?>; // Assuming this is available in your PHP scope  
            var tableId = $('#tableId').val();  
            var packageId = $('#packageId').val();  
            var reservationDate = $('#reservationDate').text();  
            var amount = parseInt($('#amount').text()) || 0;  

            var walletBalance = parseInt($('#walletBalance').text()) || 0; // Get wallet balance  
            
            // Check if wallet balance is sufficient  
            if (walletBalance < amount) {  
                alert('You do not have enough balance to make this reservation.'); // Show error message  
                return; // Stop execution of AJAX request  
            }  

            // AJAX request  
            $.ajax({  
                url: 'api/makeReservation.php',  
                type: 'POST',  
                contentType: 'application/json', // Send as JSON  
                data: JSON.stringify({  
                    userId: userId,  
                    tableId: tableId,  
                    packageId: packageId,  
                    reservationDate: reservationDate,  
                    amount: amount  
                }),  
                success: function(response) {  
                    if (response.success) {  
                        alert(response.message); // Show success message  
                        // Optionally reset the form or update the UI                        
                    } else {  
                        alert('Error: ' + response.message); // Show error message  
                    }  
                },  
                error: function(xhr, status, error) {  
                    console.error('AJAX error:', error);  
                    alert('An error occurred while making the reservation.'); // Handle request error  
                }  
            });  
        });  
    });  
</script>
</body>

</html>