<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User / Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png" sizes="180x180" />
  <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />
  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../assets/css/account-settings.css">
</head>

<body id="page-top">
<div id="wrapper">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php include __DIR__ . '/partials/topbar.php'; ?>

      <!-- content starts here -->
      <div class="container mt-5">
        <div class="profile-header">
          <i class="fas fa-user-circle profile-icon"></i>
          <h4>Account Settings</h4>
        </div>

        <form id="accountSettingsForm">
        <div class="row mb-3">
            <div class="col">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" value="Elliena">
            </div>
            <div class="col">
            <label for="middleName" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middleName" value="Gaputan">
            </div>
            <div class="col">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" value="Pizarro">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" value="nicole@example.com">
            </div>
            <div class="col">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" value="+63 9086093824">
            </div>
            <div class="col">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" value="30">
            </div>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" value="123 Pasig Street, Metro Manila">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-warning">Save</button>
            <button type="button" class="btn btn-outline-warning" id="cancelBtn">Cancel</button>
        </div>
        </form>

      </div>
      <!-- content ends here -->

      <?php include __DIR__ . '/partials/footer.php'; ?>
    </div>
  </div>
</div>

<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<script src="../../../assets/js/lib/jquery.min.js"></script>
<script src="../../../assets/js/lib/bootstrap.bundle.min.js"></script>
<script src="../../../assets/js/lib/jquery.easing.min.js"></script>
<script src="../../../assets/js/lib/startbootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("accountSettingsForm");
  const cancelBtn = document.getElementById("cancelBtn");

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Success!',
      text: 'Your account settings have been updated.',
      icon: 'success',
      confirmButtonText: 'OK'
    });
  });

  // Sign Out functionality
  const signoutLink = document.querySelector('.signout-link');
  if (signoutLink) {
    signoutLink.addEventListener('click', function (e) {
      e.preventDefault();
      Swal.fire({
        title: 'Sign Out',
        text: 'Are you sure you want to sign out?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, sign out',
        cancelButtonText: 'Cancel',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '../auth/logout.php';
        }
      });
    });
  }

  cancelBtn.addEventListener("click", function () {
    Swal.fire({
      title: 'Are you sure?',
      text: "Any unsaved changes will be lost.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, cancel',
      cancelButtonText: 'No, keep editing',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        // Action: redirect or reset form
        // Option 1: Redirect to another page
        window.location.href = 'dashboard.php';

        // Option 2: To just reset the form instead of redirecting:
        // form.reset();
      }
    });
  });
});
</script>



</body>
</html>
