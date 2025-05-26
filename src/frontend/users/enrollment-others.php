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
  <a href="enrollment-current.php" class="btn-summary">Enroll Current Students</a>
  <a href="enrollment-new.php" class="btn-summary">Enroll New Students</a>
</div>

<section class="fee-section">
  <h5>Uniforms and Optional Purchases</h5>
  <div class="table-responsive">
    <table class="fee-table">
      <thead>
        <tr>
          <th>Item</th>
          <th>Price (PHP)</th>
          <th>Notes</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Regular School Uniform (per set)</td><td>₱500</td><td>Includes top & bottom</td></tr>
        <tr><td>PE Uniform (per set)</td><td>₱500</td><td>Includes shirt & jogging pants</td></tr>
        <tr><td>School ID with Lanyard</td><td>₱150</td><td>Required every year</td></tr>
        <tr><td>Student Handbook</td><td>₱100</td><td>Updated yearly</td></tr>
        <tr><td>Learning Journal/Diary</td><td>₱100</td><td>For Grades 1–6 only</td></tr>
        <tr><td>Name Patch (set of 3)</td><td>₱50</td><td>Optional but recommended</td></tr>
        <tr><td>School Bag (with logo)</td><td>₱600</td><td>Optional</td></tr>
        <tr><td>Umbrella (school-branded)</td><td>₱300</td><td>Optional</td></tr>
      </tbody>
    </table>
  </div>
</section>

<!-- ends content -->
<!-- Uniform Notes Section -->
<section class="fee-section">
  <h5>📌 Notes:</h5>
  <ul style="list-style-type: disc; margin-left: 20px; color: #333; font-family: 'Nunito', sans-serif; font-size: 0.95rem;">
    <li>Uniform purchases can be made during enrollment week or at the start of classes.</li>
    <li>New students usually purchase 1–2 sets of uniforms and 1 PE uniform.</li>
    <li>Replacement items (e.g., lost ID or handbook) may be paid separately.</li>
    <li>Sizes are available for all levels from Kinder to Grade 6.</li>
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

</body>
</html>
