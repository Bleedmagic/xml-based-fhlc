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
  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../assets/css/payment-enrollment.css">
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include __DIR__ . '/partials/topbar.php'; ?>
        <!--content starts here-->
        <div class="container-fluid">
          <h4 class="payment-heading">Payment/Tagging</h4>

          <div class="payment-buttons">
            <a href="payment-enrollment.php" class="btn-summary">Payment Summary</a>
            <a href="payment-enrollment-history.php" class="btn-summary">Payment History</a>
          </div>

          <div class="table-responsive">
            <table class="table payment-table">
              <thead>
                <tr>
                  <th>FEE CATEGORY</th>
                  <th>STATUS</th>
                  <th>AMOUNT DUE</th>
                  <th>AMOUNT PAID</th>
                  <th>DUE DATE</th>
                  <th>ACTION</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tuition Fee</td>
                  <td><span class="status unpaid">❌ Unpaid</span></td>
                  <td>₱10,000.00</td>
                  <td>₱0.00</td>
                  <td>May 15, 2025</td>
                  <td><a href="payment.php" class="btn-history">PAY NOW</a></td>
                </tr>
                <tr>
                  <td>Enrollment Fee</td>
                  <td><span class="status paid">✅ Paid</span></td>
                  <td>₱1,000.00</td>
                  <td>₱1,000.00</td>
                  <td>April 10, 2025</td>
                  <td class="dash">-</td>
                </tr>
                <tr>
                  <td>Miscellaneous</td>
                  <td><span class="status partial">❗ Partial</span></td>
                  <td>₱500.00</td>
                  <td>₱200.00</td>
                  <td>June 1, 2025</td>
                  <td><a href="payment.php" class="btn-history">PAY NOW</a></td>
                </tr>
                <tr>
                  <td>Laboratory Fee</td>
                  <td><span class="status unpaid">❌ Unpaid</span></td>
                  <td>₱3,000.00</td>
                  <td>₱0.00</td>
                  <td>May 1, 2025</td>
                  <td><a href="payment.php" class="btn-history">PAY NOW</a></td>
                </tr>
                <tr>
                  <td>Field Trip</td>
                  <td><span class="status unpaid">❌ Unpaid</span></td>
                  <td>₱2,000.00</td>
                  <td>₱0.00</td>
                  <td>May 25, 2025</td>
                  <td><a href="payment.php" class="btn-history">PAY NOW</a></td>
                </tr>
              </tbody>
            </table>
          </div>
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    const finalGrades = <?= json_encode(array_values($finalGrades ?? [])) ?>;
    const submitted = <?= $submittedCount ?? 0 ?>;
    const notSubmitted = <?= $notSubmittedCount ?? 0 ?>;

    document.addEventListener('DOMContentLoaded', () => {
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
