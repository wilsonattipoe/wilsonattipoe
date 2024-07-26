
<?php
include('include/header.php');
include('include/navbar.php');

?>




<!-- Attendance code -->
<section class="attendance" style="margin-right: 2rem; margin-left: 1.5rem; overflow-y:auto;">
    <h3 class="text-center font-weight-small fixed-header" style="background-color: #2D1D4C; color:white">Recent Logins</h3>
    <div class="attendance-list">
        <table class="table">
            <thead>
                <tr>
                    <th>username</th>
                    <th>login time</th>
                    <th>logout time</th>
                    <th>description</th>
                    <th>days</th>
                    <th>logins</th>
                    <th>duration</th>
                </tr>
            </thead>
            <tbody>
                <?php $logResult = $conn->query($logQuery);
                foreach ($logResult as $logEntry) : ?>
                    <tr>
                        <td><?php echo $logEntry['user_name']; ?></td>
                        <td class="logtime"><?php echo $logEntry['login_time']; ?> | ✅</td>
                        <td class="outtime"><?php echo $logEntry['logout_time']; ?> |  ⛔ </td>
                        <td><?php echo $logEntry['user_name'] . ' ' . str_replace('User ', '', $logEntry['activity_description']); ?></td>
                        <td><?php echo $logEntry['day_of_week']; ?></td>
                        <td><?php echo $logEntry['Login']; ?></td>
                        <td><?php echo $logEntry['duration']; ?> | ⏰</td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>

<?php
// Close database connection and include footer and script files
// mysqli_close($connection);

include('include/footer.php');
include('include/script.php');
?>
