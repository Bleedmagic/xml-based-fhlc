<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Archived Complaints</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png" sizes="180x180" />
  <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />
  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../assets/css/complaints-request.css">
</head>

<body id="page-top">
<div id="wrapper">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php include __DIR__ . '/partials/topbar.php'; ?>

      <div class="container-fluid complains-request">
        <h4 class="section-title">Archives</h4>

        <div class="table-container">
          <table class="custom-table">
            <thead>
              <tr>
                <th>TYPE</th>
                <th>SUBJECT</th>
                <th>DATE SUBMITTED</th>
                <th>STATUS</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($_SESSION['archived_complaints'])) {
                  foreach (array_reverse($_SESSION['archived_complaints'], true) as $entry) {
                      echo "<tr>
                          <td>{$entry['type']}</td>
                          <td>{$entry['subject']}</td>
                          <td>{$entry['date']}</td>
                          <td class='status resolved'>{$entry['status']}</td>
                      </tr>";
                  }
              } else {
                  echo "<tr><td colspan='4'>No archived complaints or requests yet.</td></tr>";
              }
              ?>
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
</body>
</html>
