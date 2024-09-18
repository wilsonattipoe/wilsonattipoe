<?php
// search_transactions.php
include("./Database/connect.php");

if (isset($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    
    $query = "SELECT 
            adminusers.Username AS Fullname,
            activitylogs.action AS Action,
            activitylogs.action_time AS Date,
            activitylogs.details As Details
        FROM 
            activitylogs
        JOIN 
            adminusers 
        ON 
            activitylogs.adminusers = adminusers.AdminUserID
        WHERE 
            adminusers.Username LIKE '%$search%' 
        ORDER BY 
            activitylogs.action_time DESC
    ";
} else {
    $query = "SELECT 
            adminusers.Username AS Fullname,
            activitylogs.action AS Action,
            activitylogs.action_time AS Date,
            activitylogs.details As Details
        FROM 
            activitylogs
        JOIN 
            adminusers 
        ON 
            activitylogs.adminusers = adminusers.AdminUserID
        ORDER BY 
            activitylogs.action_time DESC
    ";
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <tr>
            <td>'.$row['Fullname'].'</td>
            <td>'.$row['Action'].'</td>
            <td>'.$row['Details'].'</td>
             <td>'.$row['Date'].'</td>
        </tr>
        ';
    }
} else {
    echo '<tr><td colspan="3">No results found</td></tr>';
}
?>
