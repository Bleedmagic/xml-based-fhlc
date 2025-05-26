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
  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../assets/css/enrollment.css">
</head>

<body id="page-top">
<div id="wrapper">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php include __DIR__ . '/partials/topbar.php'; ?>
      <!--content starts here-->
<div class="container-fluid">
  <h4 class="enrollment-heading">Enrollment</h4>

<div class="enrollment-buttons">
  <div class="btn-group">
    <button type="button" class="btn-summary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      School Fees
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="enrollment.php">Current Students</a>
      <a class="dropdown-item" href="enrollment-new.php">New Students</a>
      <a class="dropdown-item" href="enrollment-others.php">Other Fees</a>
    </div>
  </div>
  <a href="enroll-current.php" class="btn-summary">Enroll Current Students</a>
  <a href="enroll-new.php" class="btn-summary">Enroll New Students</a>
</div>

<section class="fee-section">
  <h5>Enrollment Fee Guide - New Students</h5>
  <div class="table-responsive">
    <table class="fee-table">
      <thead>
        <tr>
          <th>Grade Level</th>
          <th>Total Fee</th>
          <th>Payment Options</th>
          <th>What's Included</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Kinder 1</td>
          <td>₱30,500</td>
          <td>
            Annual: ₱30,500<br>
            Semi-Annual: ₱15,250 x 2<br>
            Quarterly: ₱7,625 x 4<br>
            Monthly: ₱3,050 x 10
          </td>
          <td>
            Tuition: ₱18,000<br>
            Miscellaneous: ₱4,000<br>
            Learning Materials: ₱3,000<br>
            Activity Fee: ₱2,000<br>
            Development Fee: ₱1,000<br>
            Registration Fee: ₱500<br>
            ID & Forms: ₱500<br>
            Entrance Exam: ₱500<br>
            Uniform Set: ₱1,000
          </td>
        </tr>
        <tr>
          <td>Kinder 2</td>
          <td>₱31,500</td>
          <td>
            Annual: ₱31,500<br>
            Semi-Annual: ₱15,750 x 2<br>
            Quarterly: ₱7,875 x 4<br>
            Monthly: ₱3,150 x 10
          </td>
          <td>
            Tuition: ₱19,000<br>
            Miscellaneous: ₱4,000<br>
            Learning Materials: ₱3,000<br>
            Activity Fee: ₱2,000<br>
            Development Fee: ₱1,000<br>
            Registration Fee: ₱500<br>
            ID & Forms: ₱500<br>
            Entrance Exam: ₱500<br>
            Uniform Set: ₱1,000
          </td>
        </tr>
        <tr>
          <td>Grade 1</td>
          <td>₱35,000</td>
          <td>
            Annual: ₱35,000<br>
            Semi-Annual: ₱17,500 x 2<br>
            Quarterly: ₱8,750 x 4<br>
            Monthly: ₱3,500 x 10
          </td>
          <td>
            Tuition: ₱21,000<br>
            Miscellaneous: ₱5,000<br>
            Learning Materials: ₱3,000<br>
            Activity Fee: ₱2,000<br>
            Development Fee: ₱1,000<br>
            Registration Fee: ₱1,000<br>
            ID & Forms: ₱500<br>
            Entrance Exam: ₱500<br>
            Uniform Set: ₱1,000
          </td>
        </tr>
        <tr>
          <td>Grade 2</td>
          <td>₱35,500</td>
          <td>
            Annual: ₱35,500<br>
            Semi-Annual: ₱17,750 x 2<br>
            Quarterly: ₱8,875 x 4<br>
            Monthly: ₱3,550 x 10
          </td>
          <td>
            Tuition: ₱21,500<br>
            Miscellaneous: ₱5,000<br>
            Learning Materials: ₱3,000<br>
            Activity Fee: ₱2,000<br>
            Development Fee: ₱1,000<br>
            Registration Fee: ₱1,000<br>
            ID & Forms: ₱500<br>
            Entrance Exam: ₱500<br>
            Uniform Set: ₱1,000
          </td>
        </tr>
        <tr>
          <td>Grade 3</td>
          <td>₱36,000</td>
          <td>
            Annual: ₱36,000<br>
            Semi-Annual: ₱18,000 x 2<br>
            Quarterly: ₱9,000 x 4<br>
            Monthly: ₱3,600 x 10
          </td>
          <td>
            Tuition: ₱22,000<br>
            Miscellaneous: ₱5,000<br>
            Learning Materials: ₱3,000<br>
            Activity Fee: ₱2,000<br>
            Development Fee: ₱1,000<br>
            Registration Fee: ₱1,000<br>
            ID & Forms: ₱500<br>
            Entrance Exam: ₱500<br>
            Uniform Set: ₱1,000
          </td>
        </tr>
        <tr>
          <td>Grade 4</td>
          <td>₱37,000</td>
          <td>
            Annual: ₱37,000<br>
            Semi-Annual: ₱18,500 x 2<br>
            Quarterly: ₱9,250 x 4<br>
            Monthly: ₱3,700 x 10
          </td>
          <td>
            Tuition: ₱23,000<br>
            Miscellaneous: ₱5,000<br>
            Learning Materials: ₱3,000<br>
            Activity Fee: ₱2,000<br>
            Development Fee: ₱1,000<br>
            Registration Fee: ₱1,000<br>
            ID & Forms: ₱500<br>
            Entrance Exam: ₱500<br>
            Uniform Set: ₱1,000
          </td>
        </tr>
        <tr>
          <td>Grade 5</td>
          <td>₱37,500</td>
          <td>
            Annual: ₱37,500<br>
            Semi-Annual: ₱18,750 x 2<br>
            Quarterly: ₱9,375 x 4<br>
            Monthly: ₱3,750 x 10
          </td>
          <td>
            Tuition: ₱23,500<br>
            Miscellaneous: ₱5,000<br>
            Learning Materials: ₱3,000<br>
            Activity Fee: ₱2,000<br>
            Development Fee: ₱1,000<br>
            Registration Fee: ₱1,000<br>
            ID & Forms: ₱500<br>
            Entrance Exam: ₱500<br>
            Uniform Set: ₱1,000
          </td>
        </tr>
        <tr>
          <td>Grade 6</td>
          <td>₱38,000</td>
          <td>
            Annual: ₱38,000<br>
            Semi-Annual: ₱19,000 x 2<br>
            Quarterly: ₱9,500 x 4<br>
            Monthly: ₱3,800 x 10
          </td>
          <td>
            Tuition: ₱24,000<br>
            Miscellaneous: ₱5,000<br>
            Learning Materials: ₱3,000<br>
            Activity Fee: ₱2,000<br>
            Development Fee: ₱1,000<br>
            Registration Fee: ₱1,000<br>
            ID & Forms: ₱500<br>
            Entrance Exam: ₱500<br>
            Uniform Set: ₱1,000
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<!-- ends content -->

<!-- Notes Section -->
<section class="fee-section">
  <h5>📌 Notes:</h5>
  <ul style="list-style-type: disc; margin-left: 20px; color: #333; font-family: 'Nunito', sans-serif; font-size: 0.95rem;">
    <li>The additional ₱2,500–₱3,000 covers new student needs like registration, ID, entrance test, and uniforms.</li>
    <li>Monthly payments run July to April.</li>
    <li>Quarterly payments: July, October, January, April.</li>
    <li>Annual and first installment due upon enrollment.</li>
  </ul>
</section>
  

      </div>
      <!-- ends here-->
      <?php include __DIR__ . '/partials/footer.php'; ?>
    </div>
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
  document.addEventListener('DOMContentLoaded', () => {
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
