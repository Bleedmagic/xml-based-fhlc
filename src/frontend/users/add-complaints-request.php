<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guardian') {
  header('Location: ../auth/login.php');
  exit();
}
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
  <link rel="stylesheet" href="../../../assets/css/add-complaints-request.css">
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include __DIR__ . '/partials/topbar.php'; ?>

        <div class="container-fluid complaints-form">
          <h4 class="section-title">Complaints/Request</h4>

          <form action="submit-complaints-request.php" method="POST">
            <div class="form-group">
              <label class="form-label">Type of Concern</label>
              <div class="radio-group">
                <label><input type="radio" name="type" value="Complaint" required> Complaint</label>
                <label><input type="radio" name="type" value="Request" required> Request</label>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Date Submitted</label>
              <input type="date" name="date" class="input-text" required>
            </div>

            <div class="form-group">
              <label class="form-label">Subject</label>
              <input type="text" name="subject" class="input-text" placeholder="Enter subject" required>
            </div>

            <div class="form-group">
              <label class="form-label">Message</label>
              <textarea name="message" rows="5" required></textarea>
            </div>

            <div class="button-group">
              <button type="submit" class="submit-btn" id="submitBtn">Submit</button>
              <a href="complaints-requests.php" class="cancel-btn">Cancel</a>
            </div>
          </form>
        </div>
      </div>
      <?php include __DIR__ . '/partials/footer.php'; ?>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <script src="../../../assets/js/lib/jquery.min.js"></script>
  <script src="../../../assets/js/lib/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/js/lib/jquery.easing.min.js"></script>
  <script src="../../../assets/js/lib/startbootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const form = document.querySelector("form");
      const submitBtn = document.getElementById("submitBtn");

      if (form && submitBtn) {
        form.addEventListener("submit", function(e) {
          e.preventDefault();
          Swal.fire({
            title: 'Submit Complaint/Request?',
            text: 'Are you sure you want to send this? It will be reviewed by the admin.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit',
            cancelButtonText: 'Cancel',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
            }
          });
        });
      }

      // Sign Out functionality
      const signoutLink = document.querySelector('.signout-link');
      if (signoutLink) {
        signoutLink.addEventListener('click', function(e) {
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
