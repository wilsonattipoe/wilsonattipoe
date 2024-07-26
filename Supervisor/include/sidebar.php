<style>
    .bg-gradient-0C1844 {
    background-color: #0C1844;
}
</style>



        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-0C1844 sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/Supervisor/Supervisorindex.php">
                <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-plane"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Travel And Tour </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Supervisor Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            Supervisoristrative 
            </div>

          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
                <a class="nav-link" href="/Supervisor/Supervisorindex.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Monitor Dashboard</span></a>
            </li>
            

       
           <!-- Booking Management -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-calendar"></i>
        <span>Booking Management</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Booking Managements:</h6>
            <a class="collapse-item" href="/Supervisor/ReviewBooking.php">Review Bookings</a>
        </div>
    </div>
</li>

<!-- Tour Management -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#TourManagement"
        aria-expanded="true" aria-controls="TourManagement">
        <i class="fas fa-fw fa-globe"></i>
        <span>Tour Management</span>
    </a>
    <div id="TourManagement" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Monitoring:</h6>
            <a class="collapse-item" href="/Supervisor/Analytics.php">Report</a>
        </div>
    </div>
</li>




            <!-- Divider -->
            <hr class="sidebar-divider">

<!-- //user logs -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userlogs" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-users"></i>
    <span>System Logs</span>
  </a>
  <div id="userlogs" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">System Logs:</h6>
      <a class="collapse-item" href="/Supervisor/userlogs.php">User Logs</a>
      <a class="collapse-item" href="/Supervisor/Activitylogs.php">ActivityLogs</a>

    </div>
  </div>
</li>


            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="/img/rocket.jpg" alt="...">
                <p class="text-center mb-2"><strong>Welcome</strong>Travel and Tour Supervisor Dashboard</p>
            </div>

        </ul>
        <!-- End of Sidebar -->



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>