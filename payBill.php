<?php include_once 'header.php'; ?>
<?php

include_once 'Arena.php';
include_once 'ArenaUtil.php';

$arenaUtil = new ArenaUtil();
$arena = new Arena($conn);

$userData = $arena->getUser($_SESSION['user_id']);
if ($userData) {
    $userId = $userData['user_id'];
    $userName = $userData['name'];
    $userPhone = $userData['phone'];
    $userCardNumber = $userData['card_number'];
    $userType = $userData['member_type'];
    $userWalletBalance = $userData['wallet_balance'];
    $userCreatedDate = $userData['created_date'];

} else {
    echo "User not found.";
}

?>

<body>
    <div class="row mt-2">
        <div class="col-12">
            <div class="d-flex"><img src="assets/img/arena.jpeg" width="60">
                <h3 class="ms-2">Arena Entertiment</h3>
            </div>
            <p>Amount (Ks)</p>
            <div class="input-group">  
                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>  
                <input type="hidden" name="userId" id="userId" value="<?= $userId ?>">  
                <input class="form-control" type="number" id="amount" placeholder="Enter Amount" required>  
                <button class="btn btn-primary" type="submit" id="makePayment">Pay</button>  
            </div>
        </div>
        <div class="col-12">
            <div class="text-black-50 d-flex justify-content-between">
                <p>Available Balance</p>
                <p><span>MMK&nbsp;</span><span id="walletBalance"><?= $userWalletBalance ?></span></p>
            </div>
        </div>
        <div class="col-12 align-center">
            <a href="index.php">Go Back Home</a>
        </div>
    </div>
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
<script>  
    $(document).ready(function() {  
        $('#makePayment').on('click', function(e) {  
            e.preventDefault();
            var userId = $('#userId').val(); 
            var amount = parseFloat($('#amount').val()) || 0; 

            if (amount <= 0) {  
                alert("Please enter a valid amount greater than zero.");  
                return; 
            }  

            var transactionData = {  
                transaction_id: null,
                user_id: userId,  
                reservation_id: null,
                transaction_date: new Date().toISOString(),
                amount: amount,  
                transaction_type: 'Payment'  
            };  

            $.ajax({  
                url: 'api/makePayment.php', 
                type: 'POST',  
                contentType: 'application/json', 
                data: JSON.stringify(transactionData),  
                success: function(response) {  
                    if (response.success) {  
                        alert(response.message); 
                        $('#amount').val(''); 
                    } else {  
                        alert('Error: ' + response.message); 
                    }  
                },  
                error: function(xhr, status, error) {  
                    console.error('AJAX error:', error);  
                    alert('An error occurred while processing your payment.');  
                }  
            });  
        });  
    });  
</script>
</body>

</html>