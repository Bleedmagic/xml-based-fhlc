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
  <link rel="stylesheet" href="../../../assets/css/change-pass.css">
</head>

<body id="page-top">
<div id="wrapper">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php include __DIR__ . '/partials/topbar.php'; ?>

      <!-- content starts here -->
      <div class="change-password-container">
        <div class="text-center mb-4">
          <i class="fas fa-user-circle fa-5x"></i>
          <h5 class="change-password-title">Change Password</h5>
        </div>
        <form id="changePasswordForm">
          <div class="form-group">
            <label for="old-password">Old Password</label>
            <div class="password-wrapper">
              <input type="password" class="form-control" id="old-password" required>
              <i class="far fa-eye toggle-password" toggle="#old-password"></i>
            </div>
          </div>

          <div class="form-group">
            <label for="new-password">New Password</label>
            <div class="password-wrapper">
              <input type="password" class="form-control" id="new-password" required>
              <i class="far fa-eye toggle-password" toggle="#new-password"></i>
            </div>
            <small class="text-muted password-requirements">
              Password must be at least 8 characters, contain 1 uppercase letter, 1 lowercase letter, 1 number, and 1 symbol.
            </small>
          </div>

          <div class="form-group">
            <label for="retype-password">Re-type Password</label>
            <div class="password-wrapper">
              <input type="password" class="form-control" id="retype-password" required>
              <i class="far fa-eye toggle-password" toggle="#retype-password"></i>
            </div>
          </div>

          <button type="submit" class="btn btn-warning btn-block font-weight-bold">Update Password</button>
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
  $(document).ready(function() {
    $(".toggle-password").click(function() {
      let input = $($(this).attr("toggle"));
      if (input.attr("type") === "password") {
        input.attr("type", "text");
        $(this).removeClass("fa-eye").addClass("fa-eye-slash");
      } else {
        input.attr("type", "password");
        $(this).removeClass("fa-eye-slash").addClass("fa-eye");
      }
    });

    $('#changePasswordForm').submit(function(e) {
      e.preventDefault();

      const newPassword = $('#new-password').val();
      const retypePassword = $('#retype-password').val();

      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

      if (!passwordRegex.test(newPassword)) {
        showToast('Invalid Password. Make sure it meets all requirements.', 'error');
        return;
      }

      if (newPassword !== retypePassword) {
        showToast('Passwords do not match. Please retype correctly.', 'error');
        return;
      }

      // All validations passed
      showToast('Password Updated Successfully!', 'success');
    });

    function showToast(message, type) {
      Swal.fire({
        toast: true,
        position: 'top',
        icon: type,
        title: message,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: {
          popup: 'custom-swal-toast'
        },
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer);
          toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
      });
    }

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
  });
</script>

</body>
</html>
