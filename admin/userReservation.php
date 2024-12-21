
<?php 
include_once 'include/header.php'; 
?>
<?php 
include_once('include/DatabaseController.php');
$dbController = new DatabaseController($conn);
$userId = $_GET['user_id'];
$reservations = $dbController->getReservationByUserId($userId);

?>

        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Reservations</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reservations</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Reservations                             
                        </div>

                        <div class="card-body" id="printableArea">
                            <div class="print-header text-center mb-4 d-none d-print-block">  
                                <h2>Reservations</h2> 
                            </div>

                            <table class="table table-striped table-bordered" id="example">
                            <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Table</th>
                                            <th>Package</th>
                                            <th>Reservation Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Table</th>
                                            <th>Package</th>
                                            <th>Reservation Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($reservations as $reservation) :?>
                                            <tr>
                                                <td><?php echo $reservation['name'];?></td>
                                                <td><?php echo $reservation['table_name'];?></td>
                                                <td><?php echo $reservation['description'];?></td>
                                                <td><?php echo $reservation['reservation_date'];?></td>
                                                <td><?php echo $reservation['sitting'];?></td>
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