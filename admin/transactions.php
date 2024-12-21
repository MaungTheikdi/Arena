<?php 
include_once 'include/header.php'; 
?>
<?php 
include_once('include/DatabaseController.php');
$dbController = new DatabaseController($conn);

$transactions = $dbController->getAllTransactions();

?>

        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Transactions</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transactions</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Transactions                             
                        </div>

                        <div class="card-body" id="printableArea">
                            <div class="print-header text-center mb-4 d-none d-print-block">  
                                <h2>Transactions</h2> 
                            </div>

                            <table class="table table-striped table-bordered" id="example">
                            <thead>
                                        <tr>
                                        <th>Name</th>
                                            <th>Transaction ID</th>
                                            <th>Transaction Date</th>
                                            <th>Amount</th>                                            
                                            <th>Transaction Type</th>                                            
                                            <th>Sofa</th>                                            
                                            <th>Reservation Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Transaction ID</th>
                                            <th>Transaction Date</th>
                                            <th>Amount</th>                                            
                                            <th>Transaction Type</th>                                            
                                            <th>Sofa</th>                                            
                                            <th>Reservation Date</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($transactions as $transaction) :?>
                                           <!--
                                            transaction_id
                                            transaction_date
                                            amount
                                            transaction_type
                                            name
                                            reservation_date
                                            table_name-->

                                            <tr>                                                
                                                <td><?php echo $transaction['name'];?></td>
                                                <td><?php echo $transaction['transaction_id'];  ?></td>                                                
                                                <td><?php echo $transaction['transaction_date'];?></td>                                                
                                                <td><?php echo $transaction['amount'];?></td>                                                
                                                <td><?php echo $transaction['transaction_type'];?></td>
                                                <td><?php echo $transaction['table_name'];?></td>
                                                <td><?php echo $transaction['reservation_date'];?></td>
                                            </tr>
                                        <?php endforeach;?>
                                
                                    </tbody>
                            </table>
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