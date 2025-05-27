<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guardian') {
  header('Location: ../auth/login.php');
  exit();
}

// archives.php
$xmlFile = __DIR__ . '/../../data/private/complaints-requests-user.xml';

if (!file_exists($xmlFile)) {
  die('Data file not found.');
}

$xml = simplexml_load_file($xmlFile);
if ($xml === false) {
  die('Failed to load XML file.');
}

$archived = [];
foreach ($xml->complaint as $complaint) {
  if (strtolower((string)$complaint->status) === 'archived') {
    $archived[] = [
      'type' => (string)$complaint->type,
      'subject' => (string)$complaint->subject,
      'date' => (string)$complaint->date,
      'status' => (string)$complaint->status,
    ];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Archived Complaints</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png" sizes="180x180" />
  <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />
  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet" />
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../../assets/css/complaints-request.css" />
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
                <?php if (!empty($archived)): ?>
                  <?php foreach (array_reverse($archived) as $entry): ?>
                    <tr>
                      <td><?= htmlspecialchars($entry['type']) ?></td>
                      <td><?= htmlspecialchars($entry['subject']) ?></td>
                      <td><?= htmlspecialchars($entry['date']) ?></td>
                      <td class="status archived"><?= htmlspecialchars($entry['status']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="4">No archived complaints or requests yet.</td>
                  </tr>
                <?php endif; ?>
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

  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
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
