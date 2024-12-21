<?php include_once 'header.php'; ?>

<?php
include_once('Arena.php');
$arena = new Arena($conn);
$transactionId = $_GET['transaction_id'];
$userId = $_SESSION['user_id'];
$transaction = $arena->getTransaction($transactionId, $userId);
if ($transaction) {
    // transaction_id user_id reservation_id transaction_date amount transaction_type
    $transactionId = $transaction['transaction_id'];
    $reservationId = $transaction['reservation_id'];
    $transactionDate = $transaction['transaction_date'];
    $amount = $transaction['amount'];
    $transactionType = $transaction['transaction_type'];
} else {
    header('Location: index.php');
}
?>

<body class="arena-bg">
    <div class="row m-3">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center justify-content-between"><img
                        src="assets/img/arena.jpeg" width="45">
                    <h6>E-Receipt</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center card-title">-<?= number_format($amount) ?> (Ks)</h1>
                    <div class="mb-1">
                        <p class="text-black-50 mb-0">Transaction Time</p>
                        <p class="text-dark mb-0"><?= $transactionDate ?></p>
                    </div>
                    <div class="mb-1">
                        <p class="text-black-50 mb-0">Transaction No</p>
                        <p class="text-dark mb-0"><?= $transactionId ?></p>
                    </div>
                    <div class="mb-1">
                        <p class="text-black-50 mb-0">Transaction Type</p>
                        <p class="text-dark mb-0"><?= $transactionType ?></p>
                    </div>
                    <div class="mb-1">
                        <p class="text-black-50 mb-0">Transfer To</p>
                        <p class="text-dark mb-0">Arena</p>
                    </div>
                    <div class="mb-1">
                        <p class="text-black-50 mb-0">Amount</p>
                        <p class="text-dark mb-0">-<?= number_format($amount) ?> (Ks)</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-black-50 mb-0">Notes</p>
                        <p class="text-dark mb-0">
                            <?php
                            if ($transactionType == 'Reservation') {
                                $reservation = $arena->getReservationById($reservationId);
                                echo 'Reservation: ' . $reservation['table_name'] . '<br/>';
                                echo 'Packages: ' . $reservation['description'];
                            } else {
                                echo $transactionType;
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center"><img src="assets/img/arena.jpeg"
                            width="30">
                        <h6 class="ms-2">Be Happy with Arena</h6>
                    </div>
                    <p class="text-center" style="font-size: 10px;">The e-receipt only means you already paid for the
                        Arena. You need to confirm the final transaction status with Arena.</p>
                </div>
            </div><a href="transactionHistory.php" class="btn btn-primary my-3" type="button"
                style="width: 100%;">Close</a>
        </div>
    </div>
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/tdm.js"></script>
</body>

</html>