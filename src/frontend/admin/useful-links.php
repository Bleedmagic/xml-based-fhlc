<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- META TAGS -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php $currentPage = 'useful-links'; ?>
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
          <h1 class="h3 mb-2 text-gray-800">Useful Links</h1>
          <p class="mb-4">Below are useful links to educational tools and resources designed to support teaching, learning, and classroom management.</p>

          <!-- Add useful links form -->
          <form id="link-form" class="mb-4">
            <div class="form-group">
              <label for="title">Link Title</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
              <label for="url">Link URL</label>
              <input type="url" class="form-control" id="url" name="url" required placeholder="https://example.com">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Add Link</button>
          </form>

          <!-- List of saved links -->
          <h5>Your Saved Links</h5>
          <ul id="link-list" class="list-unstyled"></ul>

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
    $(document).ready(function() {
      const $linkList = $('#link-list');
      const $form = $('#link-form');

      // Fetch saved links from backend (to be created)
      function fetchLinks() {
        $.ajax({
          url: 'scripts/useful-links-handler.php',
          method: 'GET',
          dataType: 'json',
          success: function(data) {
            $linkList.empty();
            if (data.length === 0) {
              $linkList.append('<li>No links saved yet.</li>');
              return;
            }
            data.forEach(link => {
              $linkList.append(`<li><a href="${link.url}" target="_blank">${link.title}</a></li>`);
            });
          },
          error: function() {
            $linkList.html('<li>Error loading links.</li>');
          }
        });
      }

      // Handle form submission to add new link
      $form.submit(function(e) {
        e.preventDefault();
        const title = $('#title').val();
        const url = $('#url').val();

        $.ajax({
          url: 'scripts/useful-links-handler.php',
          method: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            title,
            url
          }),
          success: function(response) {
            if (response.success) {
              $form[0].reset();
              fetchLinks();
            } else {
              alert(response.error || 'Failed to save link');
            }
          },
          error: function() {
            alert('Error saving link.');
          }
        });
      });

      // Initial fetch on page load
      fetchLinks();
    });
  </script>
  <!-- -------------- -->

  <!-- SIEVE JS -->
  <!-- <script src="../../../assets/js/lib/jquery.sieve.js"></script> -->

  <!-- SweetAlert2 JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    // Export
    document.querySelector('.export-link').addEventListener('click', function(event) {
      event.preventDefault();

      Swal.fire({
        title: 'Export Data',
        text: 'Do you want to export your data?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, export it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch('export.php')
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
