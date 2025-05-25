<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  echo "Unauthorized access.";
  exit();
}
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./dashboard.php">
    <div class="sidebar-brand-icon">
      <img src="../../../assets/img/fhlc-logo.png" alt="fhlc-logo" width="50" height="50">
    </div>
    <div class="sidebar-brand-text mx-3">Admin <sup>FHLC</sup></div>
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
  <li class="nav-item <?= in_array($currentPage, ['faculty', 'students', 'grades-remarks', 'sections']) ? 'active' : '' ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
      aria-expanded="<?= in_array($currentPage, ['faculty', 'students', 'grades-remarks', 'sections']) ? 'true' : 'false' ?>"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-school"></i>
      <span>Academic Management</span>
    </a>
    <div id="collapseTwo" class="collapse <?= in_array($currentPage, ['faculty', 'students', 'grades-remarks', 'sections']) ? 'show' : '' ?>"
      aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Academic Management:</h6>
        <a class="collapse-item <?= ($currentPage === 'faculty') ? 'active' : '' ?>" href="faculty.php">Faculty</a>
        <a class="collapse-item <?= ($currentPage === 'students') ? 'active' : '' ?>" href="students.php">Students</a>
        <a class="collapse-item <?= ($currentPage === 'grades-remarks') ? 'active' : '' ?>" href="grades-remarks.php">Grades and Remarks</a>
        <a class="collapse-item <?= ($currentPage === 'sections') ? 'active' : '' ?>" href="sections.php">Sections</a>
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
    Tools
  </div>

  <!-- Nav Item - Links -->
  <li class="nav-item <?= ($currentPage === 'useful-links') ? 'active' : '' ?>">
    <a class="nav-link" href="useful-links.php">
      <i class="fas fa-fw fa-link"></i>
      <span>Useful Links</span></a>
  </li>

  <!-- Nav Item - Export -->
  <li class="nav-item <?= ($currentPage === 'export') ? 'active' : '' ?>">
    <a class="nav-link export-link" href="#">
      <i class="fas fa-fw fa-file-export"></i>
      <span>Export</span></a>
  </li>

  <!-- Nav Item - Settings -->
  <li class="nav-item <?= ($currentPage === 'settings') ? 'active' : '' ?>">
    <a class="nav-link" href="./settings.php">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Settings</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
