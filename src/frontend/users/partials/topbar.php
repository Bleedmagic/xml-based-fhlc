<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Title -->
  <div class="custom-title d-flex align-items-center mr-auto ml-md-3 my-2 my-md-0">
    <h6 class="full-text m-0 font-weight-bold text-primary">Full House Learning Center</h6>
    <h6 class="abbr-text m-0 font-weight-bold text-primary d-none">FHLC</h6>
  </div>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">USER</span>
        <img class="img-profile rounded-circle"
          src="../../../assets/svg/default_profile.svg">
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="./account-settings.php">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          Account Information
        </a>
        <a class="dropdown-item" href="./change-pass.php">
          <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
          Change Password
       </a>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Sign Out Button -->
    <li class="nav-item d-flex align-items-center">
      <a class="nav-link d-flex align-items-center justify-content-center signout-link"
        href="../auth/login.php" style="color: black; background-color: #FBCD5F; border: 2px solid black; border-radius: 0.35rem; height: 40px; padding: 0 1rem; margin-left: 1rem; transition: all 0.3s ease;">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
        <span class="d-none d-sm-inline">Sign Out</span>
      </a>
    </li>

  </ul>

</nav>
