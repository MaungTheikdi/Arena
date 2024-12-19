
<?php include_once 'header.php'; 

?>

<?php 
include('phpqrcode/qrlib.php');
include_once 'Arena.php';
include_once 'ArenaUtil.php';



$arenaUtil = new ArenaUtil();
$arena = new Arena($conn);  


// Get user data
$userData = $arena->getUser($_SESSION['user_id']);  
if ($userData) {  
    $userId = $userData['user_id'] ;  
    $userName = $userData['name'] ;  
    $userPhone = $userData['phone'] ;
    $userCardNumber = $userData['card_number'] ;
    $userType = $userData['member_type'] ; 
    $userWalletBalance = $userData['wallet_balance'] ;
    $userCreatedDate = $userData['created_date'] ;    
} else {  
    echo "User not found.";  
}  
// Get events data
$eventsData = $arena->getEvents();
if ($eventsData) {
    $events = $eventsData;
} else {
    echo "Events not found.";
}


$reservationsData = $arena->getUserReservations($_SESSION['user_id']);
$reservationQR = '';
$file = 'qrcode.png';

if ($reservationsData && is_array($reservationsData)) {
    $reservationQR = $reservationsData['user_id'] . '/' . $reservationsData['reservation_id'];
    // Generate the QR code to a file
    QRcode::png($reservationQR, $file); 
    $reservationsDataStatus = "";
} else {
    $reservationQR = "";
    // Optionally generate an empty QR code or ensure the fallback image is used
    QRcode::png($reservationQR, $file); 
    $reservationsDataStatus = "Reservations not found."; 
}



// Get days
$days = $arenaUtil->getNext7Days();



?>

<body class="arena-bg">
    <div class="row">
        <div class="col text-center pt-3"><img class="img-fluid" src="assets/img/arena.jpeg" width="72"></div>
    </div>
    <div class="row">
        <div class="col px-4 py-2">
            <div class="card rounded-4 text-white" style="background: #9028f7;">
                <div class="card-body p-2">
                    <h6 class="text-white-50 p-0 m-0 card-number" id="card_number">
                        CARD NUMBER: <?= $arenaUtil->formatCardNumber($userCardNumber) ?>
                    </h6>
                    <h4 class="card-title" id="user_name"><?= $_SESSION['name']; ?></h4>
                    <p class="m-0" id="walletBalance">Wallet Balance: $ <?= $userWalletBalance ?></p>
                    <span class="badge rounded-pill bg-primary" id="memberType" ><?= $userType ?></span>
                    <a class="float-end p-2" href="logout.php">
                        <i class="fas fa-sign-out-alt text-white-50"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col d-flex flex-row justify-content-evenly align-items-center text-center"><a class="btn btn-sm mx-1 tdm-button" role="button" data-bs-target="#modal-QR" data-bs-toggle="modal"><i class="la la-qrcode d-block"></i>Quick</a><a class="btn btn-sm mx-1 tdm-button" role="button" href="payBill.php"><i class="la la-money d-block"></i>PayBill</a><a class="btn btn-sm mx-1 tdm-button" role="button" href="transactionHistory.php"><i class="la la-list d-block"></i>History</a><a class="btn btn-sm mx-1 tdm-button" role="button" href="profile.php"><i class="la la-user d-block"></i>Profile</a></div>
    </div>
    <div class="row">
        <div class="col pe-4 py-2"><a class="link-secondary float-end" href="#">View All Events</a></div>
    </div>
    <div class="row px-3">
        <div class="col-12">
            <div class="scroll-container d-flex overflow-scroll">
                <?php foreach ($events as $event): ?>
                <a class="flex-shrink-0" href="#">
                    <img class="rounded img-fluid me-2 flex-shrink-0" src="<?php echo "admin/".$event['image_url']; ?>" width="250px">
                </a> 
                <?php endforeach;?>               
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="text-secondary ps-4 mb-0">Choose a data for reservation</p>
        </div>
        <div class="col-12 px-3">
            <div class="scroll-container d-flex overflow-scroll p-3">
                <div class="me-3 flex-shrink-0">
                    <?php foreach($days as $day): ?>
                    <a class="btn btn-primary btn-sm rounded-4 me-3" role="button" href="fetchTables.php?date=<?php echo $day->format('Y-m-d'); ?>" style="min-width: 50px;">
                        <span class="d-block"><?php echo $day->format('D'); ?></span>
                        <span class="d-block"><?php echo $day->format('d'); ?></span>
                    </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-QR">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tonight</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <?php if (strlen($reservationQR) > 0 && file_exists($file)): ?>
                        <input type="hidden" id="reservationQR" value="<?php echo $reservationQR;?>">
                        <img class="img-fluid" width="200" height="200" src="<?php echo $file . '?t=' . time(); ?>">
                    <?php else: ?>
                        <img class="img-fluid" width="200" height="200" src="assets/img/arena.jpeg">
                    <?php endif; ?>
                    <p><?= htmlspecialchars($reservationsDataStatus) ?></p>
                </div>
                <div class="modal-footer">
                    Sitting? 
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">No!</button>
                    <button class="btn btn-success" type="button" id="updateToYes">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script>
        const container = document.querySelector('.scroll-container');
        container.style.scrollBehavior = 'smooth';
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#updateToYes').on('click', function() {
                const reservationQR = $('#reservationQR').val();
                const [user_id, reservation_id] = reservationQR.split('/');

                if (user_id && reservation_id) {
                    $.ajax({
                        url: 'http://localhost/arena/api/updateReservationSittingYes.php',
                        type: 'POST',
                        data: { user_id: user_id.trim(), reservation_id: reservation_id.trim() },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message);
                                if(response.status === 'success'){
                                    window.location.reload();
                                }
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                } else {
                    alert('Invalid QR code format. It should be in the format "user_id/reservation_id".');
                }
            });
        });
    </script>
</body>

</html>