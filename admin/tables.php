<?php 
include_once 'include/header.php'; 
?>
<?php 
include_once('include/DatabaseController.php');
$dbController = new DatabaseController($conn);

$tables = $dbController->getAllTables();

?>

        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tables</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tables                             
                        </div>

                        <div class="card-body" id="printableArea">
                            <div class="print-header text-center mb-4 d-none d-print-block">  
                                <h2>Tables</h2> 
                            </div>

                            <table class="table table-striped table-bordered" id="example">
                            <thead>
                                        <tr>
                                        <th>ID</th>
                                            <th>Table Type</th>
                                            <th>Table Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Table Type</th>
                                            <th>Table Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($tables as $table) :?>
                                            <tr>
                                                <td><?php echo $table['table_id'];?></td>
                                                <td><?php echo $table['name'];?></td>
                                                <td><?php echo $table['table_name'];?></td>
                                                 <td><?php echo $table['status'];?></td>
                                                 <td> 
                                                 <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                 <a href="#" class="btn btn-danger btn-sm">Delete</a></td>
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