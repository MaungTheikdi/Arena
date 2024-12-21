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

                            <?php include_once('events.php'); ?>

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