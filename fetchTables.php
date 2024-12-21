<?php include_once 'header.php'; ?>

<?php 
include_once('Arena.php');
include_once('ArenaUtil.php');
$arenaUtil = new ArenaUtil();
// Get today's date 
$today = new DateTime(); 
$todayFormatted = $today->format('Y-m-d'); 
// Calculate the date 7 days from today 
$maxDate = new DateTime(); 
$maxDate->modify('+7 days'); 
$maxDateFormatted = $maxDate->format('Y-m-d'); 
// If date is set in GET parameter, otherwise use today's date 
$date = isset($_GET['date']) ? $_GET['date'] : $todayFormatted;

$arena = new Arena($conn);  
$tables = $arena->getTables($date);
?>

<body>
    <div class="row mt-2 mb-2">
        <div class="col">
            <input 
                id="date-picker" class="m-auto form-select" type="date" style="width: 210px;" 
                value="<?php echo htmlspecialchars($date); ?>"
                min="<?php echo $todayFormatted; ?>" max="<?php echo $maxDateFormatted ?>" onchange="updateURLWithDate()"
            >
        </div>
    </div>
    <div class="row gx-0">
        <?php foreach ($tables as $table): ?>
        <div class="col-3 text-center mb-2">
            <?php
            // Determine the class based on whether table_name starts with a specific character
            $class = '';
            if (strpos($table['table_name'], 'ST') !== false) {
                $class = 'standing_table';
            } elseif ($arenaUtil->checkStartWith($table['table_name'], 'R')) {
                $class = 'regular_sofa';
            } elseif ($arenaUtil->checkStartWith($table['table_name'], 'B')) {
                $class = 'bronze_sofa';
            } elseif (strpos($table['table_name'], 'SILVER') !== false) {
                $class = 'silver_sofa';
            } elseif ($arenaUtil->checkStartWith($table['table_name'], 'D')){
                $class = 'diamond_sofa';
            } else {
                $class = 'booked_sofa';
            }

            // Determine the button class based on table_status
            $buttonClass = ($table['table_status'] === 'Reserved') ? 'booked_sofa' : 'avaliable';
            ?>

            <button class="btn btn-primary <?php echo $buttonClass . ' ' . $class; ?> btn-sm mx-1 arena-sofa" type="button"
                    data-bs-toggle="modal" data-bs-target="#tableInfoModal" 
                    data-table-id="<?php echo $table['table_id']; ?>"
                    data-table-name="<?php echo $table['table_name']; ?>"
                    data-table-type="<?php echo $table['table_type']; ?>"
                    data-package-descriptions="<?php echo $table['package_descriptions'];?>"

                    data-package-prices="<?php echo $table['package_prices']; ?>"
                    data-table-status="<?php echo $table['table_status']; ?>"
                    >
                <i class="fas fa-couch d-block" style="font-size: x-large; color: white;"></i>
                <?php echo $table['table_name']; ?>
            </button>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tableInfoModal" tabindex="-1" aria-labelledby="tableInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableInfoModalLabel">Table Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Table Name:</strong> <span id="modalTableName"></span></p>
                    <p><strong>Table Status:</strong> <span id="modalTableStatus"></span></p>
                    <p><strong>Package Descriptions:</strong> <span id="modalPackageDescriptions"></span></p>
                    <p><strong>Package Prices:</strong> <span id="modalPackagePrices"></span></p>
                    <p><strong>Seleted Date:</strong> <span id="modalSelectedDate">ACB<br>ESC</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a id="bookButton" href="#" class="btn btn-primary">Book</a>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script>
        function updateURLWithDate() { 
            const selectedDate = document.getElementById('date-picker').value; 
            const baseUrl = "<?php echo 'https://theikdimaung.com/arena/fetchTables.php'; ?>"; 
            window.location.href = `${baseUrl}?date=${selectedDate}`; 
        }

        document.addEventListener('DOMContentLoaded', function () {

            const tableButtons = document.querySelectorAll('.arena-sofa');
            tableButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const tableType = this.getAttribute('data-table-type');
                    const tableName = this.getAttribute('data-table-name');
                    const tableStatus = this.getAttribute('data-table-status');
                    const tableId = this.getAttribute('data-table-id');
                    const packageDescriptions = this.getAttribute('data-package-descriptions');
                    const output = packageDescriptions.replace(/,(?! )/g, " or ");

                    const packagePrices = this.getAttribute('data-package-prices');
                    const splitData = packagePrices.split(',')[0].trim(); 
                    const selectedDate = document.getElementById('date-picker').value;

                    document.getElementById('tableInfoModalLabel').textContent = tableType;
                    document.getElementById('modalTableName').textContent = tableName;
                    document.getElementById('modalTableStatus').textContent = tableStatus;
                    document.getElementById('modalPackageDescriptions').textContent = output;
                    document.getElementById('modalPackagePrices').textContent = splitData;
                    document.getElementById('modalSelectedDate').textContent = selectedDate;
                    


                    const bookButton = document.getElementById('bookButton');
                    if (tableStatus === 'Available') {
                        bookButton.style.display = 'block';
                        bookButton.href = `reservation.php?table_type=${tableType}&table_id=${tableId}&date=${selectedDate}&amount=${splitData}&table_name=${tableName}`;
                    } else {
                        bookButton.style.display = 'none';
                    }
                });
            });
        });

    </script>
</body>
</html>
