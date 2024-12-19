<?php include_once 'header.php'; ?>

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
    
    $file = 'qrcode.png';
    QRcode::png($userCardNumber, $file); 

} else {  
    echo "User not found.";  
}  


?>

<body class="arena-bg">
    <div class="row text-white">
        <div class="col text-center"><img class="m-4" src="assets/img/arena.jpeg" width="80">
            <h1><?= $_SESSION['name'] ?></h1>
            <h6><?= $arenaUtil->formatCardNumber($userCardNumber) ?></h6>
        </div>
    </div>
    <div class="row text-white mt-2">
        <div class="col p-2">
            <div class="d-flex justify-content-between ms-2 mb-2">
                <div><i class="fas fa-phone-alt me-2"></i><span id="reservationDate"><?= $userPhone ?></span></div>
            </div>
            <div class="d-flex justify-content-between ms-2 my-3">
                <div><i class="fas fa-user me-2"></i><span id="price-1"><?= $userType ?></span></div>
            </div>
            <div class="d-flex justify-content-between ms-2 mb-2">
                <div><i class="fas fa-dollar-sign me-2"></i><span id="price-3">Wallet Balance: $ <?= ' '.$userWalletBalance ?></span></div>
            </div><button class="btn btn-primary" type="button" data-bs-target="#modalAddWallet" data-bs-toggle="modal" style="width: 100%;">Add Wallet</button>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modalAddWallet">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= $_SESSION['name'] ?></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center"><img width="200" height="200" src="<?php echo $file . '?t=' . time(); ?>">
                    <p><?= $arenaUtil->formatCardNumber($userCardNumber) ?></p>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
            </div>
        </div>
    </div>
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/tdm.js"></script>
</body>

</html>