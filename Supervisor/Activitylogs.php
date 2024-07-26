<?php
include('../Supervisor/include/header.php');
include('../Supervisor/include/Navbar.php');
?>

<!-- Display the activity log in HTML table format -->
<div class="container " style="max-height: 800px; overflow-y: auto;">
    <h1 class="text-center fixed-header" style="background-color:#2D1D4C; color:white;">Tour Activity Logs </h1>
  
    <table class="table " >
        <thead class="fixed-header">
            <tr>
                <th style="background-color:#2D1D4C; color:white;">user Role</th>
                <th style="background-color:#2D1D4C; color:white;">activity</th>
                <th style="background-color:#2D1D4C; color:white;">created At</th>
                
            </tr>
        </thead>
       <tbody id="log_table">
       </tbody>
    </table>
     <p class="loading">Loading Data</p>
</div>


<?php
include('../Supervisor/include/footer.php');
include('../Supervisor/include/script.php');
?>