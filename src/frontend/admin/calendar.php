<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

// Load events from XML into PHP array
$events = [];
$xmlFilePath = __DIR__ . '/../../data/private/events.xml';

if (file_exists($xmlFilePath)) {
  $xml = simplexml_load_file($xmlFilePath);
  foreach ($xml->event as $event) {
    $events[] = [
      'from' => (string)$event->from,
      'to' => (string)$event->to,
      'title' => (string)$event->title,
      'description' => (string)$event->description,
    ];
  }
}
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

  <?php $currentPage = 'calendar'; ?>
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
  <link rel="stylesheet" href="../../../assets/css/lib/calendar.js.css">

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
          <h1 class="h3 mb-2 text-gray-800">Calendar</h1>
          <p class="mb-4">Use this calendar to efficiently track and manage all guardian submissions related to student concerns, academic support needs, and special requests.</p>

          <!-- Content Row -->
          <div class="row">

            <!-- Academic Calendar -->
            <div class="container-fluid">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Important Dates & Events</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div id="calendar-container"></div>
                  <div class="mt-4 text-center small">
                    <span>Calendar loaded via calendar-js</span>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include __DIR__ . '/partials/footer.php'; ?>
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
    <!-- -------------- -->

    <!-- Calendar JS -->
    <script src="../../../assets/js/lib/calendar.js"></script>
    <script>
      var savedEvents = <?= json_encode($events) ?>;

      var calendarInstance = new calendarJs("calendar-container", {
        exportEventsEnabled: true,
        useAmPmForTimeDisplays: true,
        manualEditingEnabled: true,
        useLocalStorageForEvents: true
      });

      savedEvents.forEach(function(event) {
        event.from = new Date(event.from);
        event.to = new Date(event.to);

        const existingEvents = calendarInstance.getEvents();
        const isDuplicate = existingEvents.some(e =>
          e.title === event.title &&
          e.from.getTime() === event.from.getTime() &&
          e.to.getTime() === event.to.getTime()
        );

        if (!isDuplicate) {
          calendarInstance.addEvent(event);
        }
      });
    </script>

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
