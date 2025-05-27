<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../data/private/users.xml';

if (file_exists($xmlPath)) {
  $xml = simplexml_load_file($xmlPath);
  if ($xml === false) {
    die('Failed to parse XML file.');
  }
} else {
  die('XML file not found at path: ' . $xmlPath);
}
$currentUser = null;
foreach ($xml->user as $user) {
  if ((string)$user->email === $_SESSION['email']) {
    $currentUser = $user;
    break;
  }
}

// For Export
$exportPage  = 'users';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- META TAGS -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Web-Based Guardian and Teacher Portal with Learning Progress and Communication Tools">
  <meta name="author" content="Bleedmagic, nicoleelliena7, chvzdaniel">

  <?php $currentPage = 'settings'; ?>
  <title>Admin / <?= ucwords(str_replace('-', ' ', $currentPage)) ?></title>

  <!-- FAVICONS -->
  <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png" sizes="180x180" />
  <link rel="icon" href="../../../assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png" />
  <link rel="icon" href="../../../assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png" />
  <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />

  <!-- CUSTOM FONTS -->
  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- CORE SCRIPTS -->
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet">

  <!-- ------------- -->
  <!-- CUSTOM STYLES -->
  <link rel="stylesheet" href="../../../assets/css/dashboard.css">
  <!-- ------------- -->
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . '/partials/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include __DIR__ . '/partials/topbar.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Settings</h1>
          <p class="mb-4">Manage and customize your profile to enhance your portal experience.</p>

          <?php if (isset($_GET['updated'])): ?>
            <script>
              document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                  icon: '<?= $_GET['updated'] == 1 ? 'success' : 'error' ?>',
                  title: '<?= $_GET['updated'] == 1 ? 'Profile Updated' : 'Update Failed' ?>',
                  text: '<?= $_GET['updated'] == 1 ? 'Your profile has been saved successfully.' : 'There was an error saving your profile.' ?>',
                  confirmButtonText: 'OK'
                }).then(() => {
                  if (window.history.replaceState) {
                    const cleanUrl = window.location.protocol + '//' + window.location.host + window.location.pathname;
                    window.history.replaceState({}, document.title, cleanUrl);
                  }
                });
              });
            </script>
          <?php endif; ?>

          <?php if ($currentUser): ?>
            <form method="post" action="scripts/update-profile.php" enctype="multipart/form-data" class="mt-4">

              <div class="row mb-4 align-items-center">
                <div class="col-md-4">
                  <label for="profile_picture" class="form-label d-block">Profile Picture</label>
                  <img id="profilePreview" src="<?= '../../../' . ltrim(htmlspecialchars($currentUser->picture), '/') ?>" alt="Profile Picture" class="img-thumbnail mb-2" style="width: 100px; height: 100px; object-fit: cover;">
                  <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
                </div>

                <div class="col-md-4 d-none d-md-block"></div>

                <div class="col-md-4">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($currentUser->username ?? '') ?>">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-4">
                  <label>First Name</label>
                  <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($currentUser->first_name) ?>">
                </div>
                <div class="col-md-4">
                  <label>Middle Name</label>
                  <input type="text" name="middle_name" class="form-control" value="<?= htmlspecialchars($currentUser->middle_name) ?>">
                </div>
                <div class="col-md-4">
                  <label>Last Name</label>
                  <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($currentUser->last_name) ?>">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-4">
                  <label>Email (read-only)</label>
                  <input type="email" class="form-control" value="<?= htmlspecialchars($currentUser->email) ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label>Phone Number</label>
                  <input type="text" name="phone_number" class="form-control" value="<?= htmlspecialchars($currentUser->phone_number) ?>">
                </div>
                <div class="col-md-4">
                  <label>Age</label>
                  <input type="number" name="age" class="form-control" value="<?= htmlspecialchars($currentUser->age) ?>">
                </div>
              </div>

              <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control" rows="2"><?= htmlspecialchars($currentUser->address) ?></textarea>
              </div>

              <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          <?php else: ?>
            <p>User not found.</p>
          <?php endif; ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include __DIR__ . '/partials/footer.php' ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Core Scripts-->
  <script src="../../../assets/js/lib/jquery.min.js"></script>
  <script src="../../../assets/js/lib/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/js/lib/jquery.easing.min.js"></script>
  <script src="../../../assets/js/lib/startbootstrap.min.js"></script>

  <!-- -------------- -->
  <!-- Custom Scripts -->
  <script src="../../../assets/js/dashboard.js"></script>
  <script>
    document.getElementById('profile_picture').addEventListener('change', function(event) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('profilePreview').src = e.target.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    });
  </script>
  <!-- -------------- -->


  <!-- SweetAlert2 JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    // Export
    const currentPage = <?= json_encode($currentPage) ?>;
    const exportPage = <?= json_encode($exportPage) ?>;

    document.querySelector('.export-link').addEventListener('click', function(event) {
      event.preventDefault();

      Swal.fire({
        title: 'Export Data',
        text: `Do you want to export the data for "${currentPage}"?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, export it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // Use exportPage here instead of currentPage
          fetch('scripts/export.php?page=' + encodeURIComponent(exportPage))
            .then(response => {
              if (response.ok) {
                Swal.fire('Exported!', 'Your data has been exported.', 'success');
              } else {
                Swal.fire('Failed', 'Export failed. Please try again.', 'error');
              }
            })
            .catch(() => {
              Swal.fire('Error', 'Could not connect to export script.', 'error');
            });
        }
      });
    });

    // Sign Out
    document.querySelector('.signout-link').addEventListener('click', function(event) {
      event.preventDefault();

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
  </script>
</body>

</html>
