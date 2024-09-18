<?php

// Database connection
include('../Supervisor/Database/connect.php');

$sql = "
    SELECT 
        MONTHNAME(Dated) as month, 
        WEEK(Dated) as week, 
        COUNT(bookTour_ID) as totalBookings, 
        SUM(price) as totalAmount
    FROM 
        booktours
    WHERE 
        YEAR(Dated) = YEAR(CURDATE())  -- Filter for the current year
    GROUP BY 
        MONTH(Dated), WEEK(Dated)
    ORDER BY 
        MONTH(Dated), WEEK(Dated)
";
$result = $conn->query($sql);

$monthlyData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = $row['month'];
        $week = "Week " . $row['week'];
        
        if (!isset($monthlyData[$month])) {
            $monthlyData[$month] = [];
        }

        $monthlyData[$month][$week] = [
            'totalBookings' => $row['totalBookings'],
            'totalAmount' => $row['totalAmount']
        ];
    }
}

$formattedData = [];

foreach ($monthlyData as $month => $weeks) {
    $formattedData[$month] = [
        'bookings' => [],
        'amount' => []
    ];

    foreach ($weeks as $week => $data) {
        $formattedData[$month]['bookings'][] = $data['totalBookings'];
        $formattedData[$month]['amount'][] = $data['totalAmount'];
    }
}


?>







<!-- Dropdown menu for selecting months -->
<div class="row">
        <!-- Booking Trends Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Booking Trends</h6>
                </div>
                <div class="form-group">
    <label for="monthSelect">Select Month</label>
    <select class="form-control" id="monthSelect">
        <option value="0">January</option>
        <option value="1">February</option>
        <option value="2">March</option>
        <option value="3">April</option>
        <option value="4">May</option>
        <option value="5">June</option>
        <!-- Add options for other months -->
    </select>
</div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="bookingTrendsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>



<!-- Custom scripts for charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Initial data
    const monthlyData = {
        January: [10, 15, 20, 25, 30, 35],
        February: [12, 18, 22, 28, 33, 40],
        March: [14, 20, 25, 30, 35, 42],
        April: [16, 22, 27, 32, 37, 44],
        May: [18, 24, 29, 34, 39, 46],
        June: [20, 26, 31, 36, 41, 48]
        // Add data for other months
    };

    // Set up the booking trends chart
    const ctx = document.getElementById('bookingTrendsChart').getContext('2d');
    const bookingTrendsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'], // Example labels
            datasets: [{
                label: 'Bookings',
                data: monthlyData.January, // Default data for January
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                pointRadius: 3,
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: 'rgba(78, 115, 223, 1)',
                pointHoverRadius: 3,
                pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                pointHitRadius: 10,
                pointBorderWidth: 2,
                tension: 0.4,
            }],
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                },
                y: {
                    ticks: {
                        maxTicksLimit: 5
                    },
                    grid: {
                        color: 'rgb(234, 236, 244)',
                        zeroLineColor: 'rgb(234, 236, 244)',
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                },
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: 'rgb(255,255,255)',
                bodyColor: '#858796',
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        },
    });

    // Event listener for month selection
    document.getElementById('monthSelect').addEventListener('change', function() {
        const selectedMonth = this.options[this.selectedIndex].text;
        bookingTrendsChart.data.datasets[0].data = monthlyData[selectedMonth];
        bookingTrendsChart.update();
    });
</script>
