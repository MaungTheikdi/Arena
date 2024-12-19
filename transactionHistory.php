<?php include_once 'header.php'; ?>
<?php

include_once('Arena.php');
include_once('ArenaUtil.php');

$arena = new Arena($conn);
$utils = new ArenaUtil();

$transactions = $arena->getUserTransactions($_SESSION['user_id']);


?>
<body>
    <div class="row">
        <?php foreach ($transactions as $transaction): ?>
        <div class="col-12">
            <div class="card p-2 m-2">
                <div class="card-body">
                    <h4 class="card-title"><?= $transaction['transaction_type'] ?></h4>
                    <h6 class="text-muted card-subtitle mb-2"><?= $transaction['table_type'] .' | ' .  $transaction['table_name'] ?></h6>
                    <div class="d-flex justify-content-between">
                        <p class="text-black-50"><?= $transaction['transaction_id'] .' : '. $transaction['transaction_date'] ?></p>
                        <p class="card-text"><?= $transaction['amount'].' MMK' ?></p>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <div class="col-12 mb-4">
            <a class="btn btn-primary" href="index.php">Go Back Home</a>
        </div>
    </div>
    
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/tdm.js"></script>
</body>

</html>