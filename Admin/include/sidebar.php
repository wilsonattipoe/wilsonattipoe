<style>
    .bg-gradient-32012F {
    background-color: #32012F;
}
</style>





        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-32012F sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/Admin/Adminindex.php">
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
                    <span>Admin Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            Supervisoristrative 
            </div>

          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
                <a class="nav-link" href="/Admin/Adminindex.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Monitor Dashboard</span></a>
            </li>
            

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>User Management</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customers</h6>
                        <a class="collapse-item" href="/Admin/viewusers.php">view users</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Booking Management Menu -->
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
            <a class="collapse-item" href="/Admin/ViewBooking.php">View Bookings</a>
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
            <h6 class="collapse-header">Tour Management:</h6>
            <a class="collapse-item" href="/Admin/Addtour.php">Add Tour</a>
        </div>
    </div>
</li>

<!-- Tourtables -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Tourtables"
        aria-expanded="true" aria-controls="Tourtables">
        <i class="fas fa-fw fa-comments"></i>
        <span>Tourtables</span>
    </a>
    <div id="Tourtables" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tourtables</h6>
            <a class="collapse-item" href="/Admin/Tourtable.php">Tourtables</a>
        </div>
    </div>
</li>




<!-- Communication -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Communication"
        aria-expanded="true" aria-controls="Communication">
        <i class="fas fa-fw fa-comments"></i>
        <span>Communication</span>
    </a>
    <div id="Communication" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Newsletter</h6>
            <a class="collapse-item" href="/Admin/SendEmails.php">Customer Inquiries</a>
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
      <a class="collapse-item" href="/Admin/userlogs.php">User Logs</a>
      <a class="collapse-item" href="/Admin/Activitylogs.php">ActivityLogs</a>

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
                <p class="text-center mb-2"><strong>Welcome</strong>Travela and Tour Admin Dashboard</p>
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