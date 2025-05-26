<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $enteredOtp = trim($_POST['otp']);

  if (!isset($_SESSION['otp'], $_SESSION['otp_expires'], $_SESSION['pending_user'])) {
    $_SESSION['error_notif'] = "Session expired. Please login again.";
    header("Location: login.php");
    exit();
  }

  if (time() > $_SESSION['otp_expires']) {
    $_SESSION['error_notif'] = "OTP has expired. Please login again.";
    session_unset();
    header("Location: login.php");
    exit();
  }

  if ($enteredOtp != $_SESSION['otp']) {
    $_SESSION['error_notif'] = "Invalid OTP. Please try again.";
    header("Location: enter-otp.php");
    exit();
  }

  // OTP is valid, complete login
  $_SESSION['username'] = $_SESSION['pending_user']['username'];
  $_SESSION['email'] = $_SESSION['pending_user']['email'];
  $_SESSION['role'] = $_SESSION['pending_user']['role'];

  // Cleanup
  unset($_SESSION['otp'], $_SESSION['otp_expires'], $_SESSION['pending_user']);

  // Redirect based on role
  switch ($_SESSION['role']) {
    case 'admin':
      header("Location: ../admin/dashboard.php");
      break;
    case 'guardian':
      header("Location: ../users/dashboard.php");
      break;
    default:
      header("Location: login.php");
      break;
  }
  exit();
}
?>

<!-- HTML form for OTP input -->
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- META TAGS -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- FAVICONS -->
  <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png"
    sizes="180x180" />
  <link rel="icon" href="../../../assets/img/favicons/favicon-32x32.png" sizes="32x32"
    type="image/png" />
  <link rel="icon" href="../../../assets/img/favicons/favicon-16x16.png" sizes="16x16"
    type="image/png" />
  <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />

  <!-- PAGE TITLE -->
  <title>OTP / FHLC</title>

  <!-- CSS LIB -->
  <link rel="stylesheet" href="../../../assets/css/lib/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../assets/css/icons/bootstrap-icons.min.css" />

  <!-- Custom Styles -->
  <link rel="stylesheet" href="../../../assets/css/custom.css" />
  <link rel="stylesheet" href="../../../assets/css/floating-labels.css" />
</head>

<body>
  <div class="container d-flex align-items-center justify-content-center"
    style="min-height: 100vh;">
    <!-- Centered Form -->
    <div class="col-lg-6">
      <form class="form-signin" method="POST"
        autocomplete="off">
        <div class="text-center mb-4">
          <img src="../../../assets/img/fhlc-logo.png" alt="Logo" width="100" height="100" />
          <h1 class="h3 mb-3 font-weight-normal">Enter OTP</h1>
          <p class="text-muted">
            Please enter the 6-digit OTP sent to your email.
          </p>
        </div>

        <?php if (isset($_SESSION['error_notif'])): ?>
          <div id="otp-error" class="alert alert-danger" role="alert">
            <?= $_SESSION['error_notif'];
            unset($_SESSION['error_notif']); ?>
          </div>
        <?php endif; ?>

        <div class="form-group form-label-group">
          <input type="text" inputmode="numeric" id="otp" name="otp" class="form-control"
            placeholder="One Time Password" pattern="\d{6}" maxlength="6" required />
          <label for="otp">One Time Password</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block btn-success" type="submit"
          id="reset-password-btn">Verify Code</button>

        <div class="text-center mt-4 mb-2">
          <a href="../home.php" class="text-success">
            <i class="bi bi-house-door" style="font-size: 36px;"></i>
          </a>
        </div>
      </form>
    </div>
  </div>

  <!-- JS LIB -->
  <script type="text/javascript" src="../../../assets/js/lib/jquery.min.js"></script>
  <script type="text/javascript" src="../../../assets/js/lib/bootstrap.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const errorBox = document.getElementById('otp-error');
      const otpInput = document.getElementById('otp');

      if (otpInput && errorBox) {
        otpInput.addEventListener('input', () => errorBox.style.display = 'none');
      }
    });
  </script>
</body>

</html>
