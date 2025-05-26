<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./dashboard.php">
    <div class="sidebar-brand-icon">
      <img src="../../../assets/img/fhlc-logo.png" alt="fhlc-logo" width="50" height="50">
    </div>
    <div class="sidebar-brand-text mx-3">User <sup>FHLC</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <!-- Don't forget to Set list item as active, and set href link -->
  <li class="nav-item <?= ($currentPage === 'dashboard') ? 'active' : '' ?>">
    <a class="nav-link" href="./dashboard.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Management
  </div>

  <!-- Nav Item - Academic Management Menu -->
  <li class="nav-item <?= in_array($currentPage, ['faculty', 'students', 'grades', 'section']) ? 'active' : '' ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
      aria-expanded="<?= in_array($currentPage, ['faculty', 'students', 'grades', 'section']) ? 'true' : 'false' ?>"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-school"></i>
      <span>Academics</span>
    </a>
    <div id="collapseTwo" class="collapse <?= in_array($currentPage, ['faculty', 'students', 'grades', 'section']) ? 'show' : '' ?>"
      aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Academic Management:</h6>
        <a class="collapse-item <?= ($currentPage === 'faculty') ? 'active' : '' ?>" href="grades.php">Grades</a>
        <a class="collapse-item <?= ($currentPage === 'students') ? 'active' : '' ?>" href="assignments.php">Assignments</a>
        <a class="collapse-item <?= ($currentPage === 'grades') ? 'active' : '' ?>" href="payment-enrollment.php">Payment/Tagging</a>
        <a class="collapse-item <?= ($currentPage === 'enrollment') ? 'active' : '' ?>" href="enrollment.php">Enrollment</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Calendar Menu -->
  <li class="nav-item <?= ($currentPage === 'calendar') ? 'active' : '' ?>">
    <a class="nav-link" href="./calendar.php">
      <i class="fas fa-fw fa-calendar"></i>
      <span>Academic Calendar</span></a>
  </li>

  <!-- Nav Item - Complaints/Requests Menu -->
  <li class="nav-item <?= ($currentPage === 'complaints-requests') ? 'active' : '' ?>">
    <a class="nav-link" href="./complaints-requests.php">
      <i class="fas fa-fw fa-comments"></i>
      <span>Complaints/Requests</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    System Tools
  </div>

  <!-- Nav Item - User Settings Menu -->
<li class="nav-item <?= in_array($currentPage, ['account-info', 'change-password']) ? 'active' : '' ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
    aria-expanded="<?= in_array($currentPage, ['account-info', 'change-password']) ? 'true' : 'false' ?>"
    aria-controls="collapseSettings">
    <i class="fas fa-fw fa-user-cog"></i>
    <span>Settings</span>
  </a>
  <div id="collapseSettings" class="collapse <?= in_array($currentPage, ['account-info', 'change-password']) ? 'show' : '' ?>"
    aria-labelledby="headingSettings" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">User Settings:</h6>
      <a class="collapse-item <?= ($currentPage === 'account-info') ? 'active' : '' ?>" href="account-settings.php">Account Information</a>
      <a class="collapse-item <?= ($currentPage === 'change-password') ? 'active' : '' ?>" href="change-pass.php">Change Password</a>
    </div>
  </div>
</li>


  <!-- Nav Item - Archives -->
  <li class="nav-item <?= ($currentPage === 'archives') ? 'active' : '' ?>">
    <a class="nav-link" href="./archives.php">
      <i class='fas fa-archive'></i>
      <span>Archives</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
