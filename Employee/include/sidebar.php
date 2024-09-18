  <!-- Sidebar -->
  <ul class="navbar-nav btn-success sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-plane"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Travel And Tour </div>
</a>


<!-- Divider -->
<hr class="sidebar-divider my-0">
  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="/Employee/Employeeindex.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Monitor Dashboard</span></a>
 </li>

 <hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
Booking Handling
</div>

<!-- Booking Handling -->
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
aria-expanded="true" aria-controls="collapseTwo">
<i class="fas fa-fw fa-cogs"></i>
<span>Booking Handling</span>
</a>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
<h6 class="collapse-header">Check Bookings</h6>
<a class="collapse-item" href="/Employee/usersbooking.php">View Bookings</a>
</div>
</div>
</li>



<!-- Tour Management -->
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#TourManagement"
aria-expanded="true" aria-controls="TourManagement">
<i class="fas fa-fw fa-route"></i>
<span>Special Requests</span>
</a>
<div id="TourManagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
<h6 class="collapse-header">Update Tour Availability</h6>
<a class="collapse-item" href="/Employee/SpecialRequest.php">Special Requests</a>
</div>
</div>
</li>



<!-- Reporting -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Reporting"
    aria-expanded="true" aria-controls="Reporting">
    <i class="fas fa-fw fa-chart-bar"></i>
    <span>Announcement</span>
    </a>
    <div id="Reporting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
    <a class="collapse-item" href="/Employee/sendEmails.php">Send_emails</a>
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
<p class="text-center mb-2"><strong>Welcome</strong>Travela and Tour Employee Dashboard</p>
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
