<?php
session_start();
include("./include/header.php");
include("./include/navbar.php");
include("./Database/connect.php");





// Check if the user is logged in and has the correct role and status
if (isset($_SESSION['AdminUserID'], $_SESSION['RoleID'], $_SESSION['Username'], $_SESSION['statusID'])) {
    $roleID = $_SESSION['RoleID'];
    $statusID = $_SESSION['statusID'];
    $username = $_SESSION['Username'];

    // Only allow access if the user is an Admin and has an active status
    if ($roleID == 2 && $statusID == 1) {
   
        if (!isset($_SESSION['welcome_message_shown'])) {
            $_SESSION['welcome_message_shown'] = true; 
            displayMessage('Welcome ' . $username, 'You have successfully logged in', 'success');
        }

        // Count function: Counting the total number of items in the database
        $queries = array(
            'Total client' => "SELECT COUNT(ClientUserID) AS count FROM clientusers",
            'Total booktours' => "SELECT COUNT(bookTour_ID) AS count FROM booktours",
        );

                    // Query to get total price
            $sql = "SELECT SUM(price) AS total_price FROM booktours";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Fetch the result
                $row = $result->fetch_assoc();
                $total_price = $row['total_price'];
            } else {
                $total_price = 0;
            }

        // Execute queries and store counts
        $counts = array();
        foreach ($queries as $label => $query) {
            $result = $conn->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                $counts[$label] = $row['count'];
            } else {
                echo "Error executing query: " . $conn->error;
            }
        }
    } else {
        // Unauthorized access
        displayMessage('Error', 'Unauthorized access.', 'error', '../logout.php');
        // Log out user
        session_unset();
        session_destroy();
        exit();
    }
} else {
    // If session variables are not set, display an error and redirect to login
    displayMessage('Error', 'Session not set.', 'error', '../logout.php');
    // Log out user
    session_unset();
    session_destroy();
    exit();
}



?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
       
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h6 class="h2 mb-0 text-gray-600">Welcome,<?php echo $username; ?>,to your Supervisor Dashboard!</h6>
    </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Travel Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2><i class="fas fa-users fa-sm text-white-100" style="color: #0C1844; ">&nbsp;<?php echo $counts ["Total client"]; ?>
                        </i></h2>
                        <span><i class="fa fa-arrow-up" style="color:#0C1844;">Client users</i> </span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100" style="color:#0C1844;">&nbsp; <?php echo number_format($total_price, 2); ?></i></h2>
                    <span><i class="fa fa-arrow-up text-white-100" style="color:#0C1844;"> Revenue income</i></span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookings Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100" style="color:#0C1844;">&nbsp; <?php echo $counts ['Total booktours']; ?></i></h2>
                        <span><i class="fa fa-arrow-up text-white-100"  style="color:#0C1844;">Bookings</i></span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100" style="color:#0C1844;">&nbsp;3</i></h2>
                        <span><i class="fa fa-arrow-up text-white-100"  style="color:#0C1844;">User Feedbacks</i></span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Content Row -->




    <!-- Booking chart included here Eli -->
    <?php
    include "../Supervisor/chart.php";
    ?>

<?php
// include('../Supervisor/include/footer.php');
include('../Supervisor/include/script.php');
?>


<!-- Generate report button styling -->
<style>
    .btn-32012F {
        background-color: #0C1844;
        border-color: #0C1844;
    }
</style>
