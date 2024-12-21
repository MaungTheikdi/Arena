<?php 
include_once 'include/header.php'; 
?>
<?php 
include_once('include/DatabaseController.php');
$dbController = new DatabaseController($conn);

$allUsers = $dbController->getAllUsers();

?>

        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Users</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>



                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Users                             
                        </div>

                        <div class="card-body" id="printableArea">
                            <div class="print-header text-center mb-4 d-none d-print-block">  
                                <h2>Users</h2>  
                            </div>

                            <table class="table table-striped table-bordered" id="example">                             
                                <thead>
                                    <tr>
                                        <th>User ID</th>  
                                        <th>Name</th>  
                                        <th>Phone</th>  
                                        <th>Card Number</th>  
                                        <th>Member Type</th>  
                                        <th>Wallet Balance</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allUsers as $user): ?>  
                                    <tr>  
                                        <td><?= $user['user_id']?></td>  
                                        <td><?= $user['name']?></td>  
                                        <td><?= $user['phone']?></td>  
                                        <td><?= $user['card_number']?></td>  
                                        <td><?= $user['member_type']?></td>  
                                        <td>$ <?= number_format($user['wallet_balance']) ?></td>  
                                        <td>  
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editUserModal"  
                                                    onclick="populateEditForm('<?= $user['user_id']?>', '<?= $user['name']?>', '<?= $user['phone']?>', '<?= $user['card_number']?>', '<?= $user['member_type']?>', '<?= $user['wallet_balance']?>')">  
                                                Edit  
                                            </button>  
                                            <a href="delete_user.php?id=<?= $user['user_id']?>" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-danger btn-sm">Delete</a>  
                                        </td>  
                                    </tr>  
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                
            </div>

            <!-- Edit User Modal -->  
<div class="modal" id="editUserModal" tabindex="-1" role="dialog">  
    <div class="modal-dialog" role="document">  
        <div class="modal-content">  
            <div class="modal-header">  
                <h5 class="modal-title">Edit User</h5>  
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
                    <span aria-hidden="true">&times;</span>  
                </button>  
            </div>  
            <div class="modal-body">  
                <form id="editUserForm" method="POST" action="edit_user.php">  
                    <input type="hidden" name="user_id" id="user_id" value="">  
                    <div class="form-group">  
                        <label for="name">Name</label>  
                        <input type="text" class="form-control" name="name" id="name" required>  
                    </div>  
                    <div class="form-group">  
                        <label for="phone">Phone</label>  
                        <input type="text" class="form-control" name="phone" id="phone" required>  
                    </div>  
                    <div class="form-group">  
                        <label for="card_number">Card Number</label>  
                        <input type="text" class="form-control" name="card_number" id="card_number" required>  
                    </div>  
                    <div class="form-group">  
                        <label for="member_type">Member Type</label>  
                        <input type="text" class="form-control" name="member_type" id="member_type" required>  
                    </div>  
                    <div class="form-group">  
                        <label for="wallet_balance">Wallet Balance</label>  
                        <input type="text" class="form-control" name="wallet_balance" id="wallet_balance" required>  
                    </div>  
                    <div class="modal-footer">  
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                        <button type="submit" class="btn btn-primary">Save changes</button>  
                    </div>  
                </form>  
            </div>  
        </div>  
    </div>  
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

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>  
    function populateEditForm(userId, name, phone, cardNumber, memberType, walletBalance) {  
        document.getElementById('user_id').value = userId;  
        document.getElementById('name').value = name;  
        document.getElementById('phone').value = phone;  
        document.getElementById('card_number').value = cardNumber;  
        document.getElementById('member_type').value = memberType;  
        document.getElementById('wallet_balance').value = walletBalance;  
    }  
</script>
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