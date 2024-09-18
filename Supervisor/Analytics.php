<?php
include('../Supervisor/include/header.php');
include('../Supervisor/include/navbar.php');

// Database connection
include('../Supervisor/Database/connect.php');

// Fetch data from the tables
$sql = "SELECT t.TourTypeName, COUNT(bt.bookTour_ID) AS totalBookings, 
            COUNT(CASE WHEN bt.status = 'canceled' THEN 1 END) AS totalBookCancel, 
            COUNT(DISTINCT bt.tourSite_id) AS totalTourSites,
            (SELECT COUNT(cart_id) FROM addcart) AS totalAddToCart, 
            COUNT(DISTINCT bt.tourType_id) AS totalTourTypeVisited, 
            (SELECT COUNT(Request_id) FROM request) AS totalRequest, 
            (SELECT COUNT(FeedbackID) FROM feedback) AS totalFeedbacks
        FROM booktours bt 
        JOIN tourtypes t ON bt.tourType_id = t.TourTypeID 
        GROUP BY t.TourTypeName";

$result = $conn->query($sql);

?>

<div class="container mt-4">
    <h2>Booking Summary Report</h2>
    
    <!-- Search Input -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
    
    <!-- Download CSV Button -->
    <button id="downloadCSV" class="btn btn-primary mb-3">Download CSV</button>
    
    <div class="table-responsive">
        <table class="table table-striped" id="summaryTable">
            <thead>
                <tr>
                    <th style="background-color:#0C1844;  font-size: 13px; color:white;">Tour Type</th>
                    <th style="background-color:#0C1844;  font-size: 13px; color:white;">Total Bookings</th>
                    <th style="background-color:#0C1844;  font-size: 13px; color:white;">Total Book Cancel</th>
                    <th style="background-color:#0C1844;  font-size: 13px; color:white;">Total Tour Sites</th>
                    <th style="background-color:#0C1844;  font-size: 13px; color:white;">Total Add to Cart</th>
                    <th style="background-color:#0C1844;  font-size: 13px; color:white;">Total Tour Type Visited</th>
                    <th style="background-color:#0C1844;  font-size: 13px; color:white;">Total Request</th>
                    <th style="background-color:#0C1844;  font-size: 13px; color:white;">Total Feedbacks</th>
                </tr>
            </thead>
            <tbody3
                <?php
                $totalBookingsSum = 0;
                $totalBookCancelSum = 0;
                $totalTourSitesSum = 0;
                $totalAddToCartSum = 0;
                $totalTourTypeVisitedSum = 0;
                $totalRequestSum = 0;
                $totalFeedbacksSum = 0;
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['TourTypeName']}</td>";
                        echo "<td>{$row['totalBookings']}</td>";
                        echo "<td>{$row['totalBookCancel']}</td>";
                        echo "<td>{$row['totalTourSites']}</td>";
                        echo "<td>{$row['totalAddToCart']}</td>";
                        echo "<td>{$row['totalTourTypeVisited']}</td>";
                        echo "<td>{$row['totalRequest']}</td>";
                        echo "<td>{$row['totalFeedbacks']}</td>";
                        echo "</tr>";
                        
                        $totalBookingsSum += $row['totalBookings'];
                        $totalBookCancelSum += $row['totalBookCancel'];
                        $totalTourSitesSum += $row['totalTourSites'];
                        $totalAddToCartSum += $row['totalAddToCart'];
                        $totalTourTypeVisitedSum += $row['totalTourTypeVisited'];
                        $totalRequestSum += $row['totalRequest'];
                        $totalFeedbacksSum += $row['totalFeedbacks'];
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr style="background-color:#0C1844; color:white;">
                    <th>Totals</th>
                    <th><?php echo $totalBookingsSum; ?></th>
                    <th><?php echo $totalBookCancelSum; ?></th>
                    <th><?php echo $totalTourSitesSum; ?></th>
                    <th><?php echo $totalAddToCartSum; ?></th>
                    <th><?php echo $totalTourTypeVisitedSum; ?></th>
                    <th><?php echo $totalRequestSum; ?></th>
                    <th><?php echo $totalFeedbacksSum; ?></th>
                </tr>
            </tfoot>

        </table>
    </div>
</div>

<?php
$conn->close();
include('../Supervisor/include/footer.php');
include('../Supervisor/include/script.php');
?>

<script>
// Dynamic Search Functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toUpperCase();
    let rows = document.querySelector("#summaryTable tbody").rows;
    
    for (let i = 0; i < rows.length; i++) {
        let firstCol = rows[i].cells[0].textContent.toUpperCase();
        if (firstCol.indexOf(filter) > -1) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
});

// Download CSV Functionality
document.getElementById('downloadCSV').addEventListener('click', function() {
    let csv = [];
    let rows = document.querySelectorAll("#summaryTable tr");
    
    for (let i = 0; i < rows.length; i++) {
        let row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (let j = 0; j < cols.length; j++) {
            row.push(cols[j].innerText);
        }
        
        csv.push(row.join(","));        
    }

    // Download CSV
    let csvFile = new Blob([csv.join("\n")], {type: "text/csv"});
    let downloadLink = document.createElement("a");
    downloadLink.download = "booking_summary.csv";
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
});
</script>
