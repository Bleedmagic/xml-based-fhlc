<?php
// Sections Card
$sectionsXmlPath = __DIR__ . '/../../data/private/sections.xml';
$totalSections = 0;
if (file_exists($sectionsXmlPath)) {
  $sectionsXml = simplexml_load_file($sectionsXmlPath);
  if ($sectionsXml !== false) {
    $totalSections = count($sectionsXml->section);
  }
}

// Faculty Card
$facultyXmlPath = __DIR__ . '/../../data/private/faculty.xml';
$totalFaculty = 0;
if (file_exists($facultyXmlPath)) {
  $facultyXml = simplexml_load_file($facultyXmlPath);
  if ($facultyXml !== false) {
    $totalFaculty = count($facultyXml->teachers->teacher);
  }
}

// Students Card
$studentsXmlPath = __DIR__ . '/../../data/private/students.xml';
$totalStudents = 0;
if (file_exists($studentsXmlPath)) {
  $studentsXml = simplexml_load_file($studentsXmlPath);
  if ($studentsXml !== false) {
    foreach ($studentsXml->student as $student) {
      if (strtolower(trim((string)$student->status)) === 'active') {
        $totalStudents++;
      }
    }
  }
}

// Complaints/Requests Card
$requestsXmlPath = __DIR__ . '/../../data/private/complaints-requests.xml';
$pendingComplaintsRequests = 0;
$totalSubmissions = 0;
if (file_exists($requestsXmlPath)) {
  $requestsXml = simplexml_load_file($requestsXmlPath);
  if ($requestsXml !== false) {
    foreach ($requestsXml->submission as $submission) {
      $totalSubmissions++;
      if (strtolower(trim((string)$submission->status)) === 'pending') {
        $pendingComplaintsRequests++;
      }
    }
  }
}
$pendingPercentage = $totalSubmissions > 0
  ? round(($pendingComplaintsRequests / $totalSubmissions) * 100, 2)
  : 0;

// Passed/Failed
$gradesXmlPath = '../../data/private/grades-remarks.xml';
$xml = file_exists($gradesXmlPath) ? simplexml_load_file($gradesXmlPath) : null;
$passed = $failed = 0;
if ($xml) {
  foreach ($xml->student as $student) {
    if ((string)$student->remarks === "Passed") $passed++;
    else $failed++;
  }
}
$remarksData = json_encode([$failed, $passed]);
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

  <?php $currentPage = 'dashboard'; ?>
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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Total Faculty Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Faculty</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalFaculty ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Students Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total Students</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalStudents ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-id-badge fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Sections Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Total Sections</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalSections ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Complaints/Requests Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Pending Complaints/Requests
                      </div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?= $pendingComplaintsRequests ?> (<?= $pendingPercentage ?>%)
                          </div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-warning" role="progressbar"
                              style="width: <?= $pendingPercentage ?>%;"
                              aria-valuenow="<?= $pendingPercentage ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- @TODO New -->
            <div class="col-xl-4 col-lg-4">
              <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success">Under Construction</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <span>erm</span>
                  <div class="mt-4 text-center small">
                    <span>Under Construction</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Grades and Remarks -->
            <div class="col-xl-4 col-lg-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success">Grades and Remarks</h6>
                </div>
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="gradesAndRemarks"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Passed
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Failed
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Complaints/Request -->
            <div class="col-xl-4 col-lg-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success">Complaints/Request</h6>
                </div>
                <div class="card-body">
                  <div class="pt-0 pb-1">
                    <?php
                    $xmlPath = $requestsXmlPath;
                    $xml = simplexml_load_file($xmlPath) or die("Error: Cannot load XML.");

                    $pending = [];

                    foreach ($xml->submission as $s) {
                      if (strtolower((string)$s->status) === 'pending') {
                        $pending[] = $s;
                      }
                    }

                    usort($pending, function ($a, $b) {
                      return strtotime($b->submitted_date) - strtotime($a->submitted_date);
                    });

                    $maxDisplay = min(10, count($pending));
                    if ($maxDisplay === 0) {
                      echo "<p class='text-muted'>No pending submissions.</p>";
                    } else {
                      for ($i = 0; $i < $maxDisplay; $i++) {
                        echo "<p class='mb-1 text-truncate' title='" . htmlspecialchars($pending[$i]->subject) . "'>• " . htmlspecialchars($pending[$i]->subject) . "</p>";
                      }
                    }
                    ?>
                  </div>
                  <div class="mt-3 text-center small">
                    <span class="text-muted">Showing 10 latest and pending</span>
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

    <!-- Chart JS -->
    <script>
      const gradesRemarksData = <?php echo $remarksData; ?>;
    </script>
    <script src="../../../assets/js/lib/chart.min.js"></script>
    <script src="../../../assets/js/chart-pie-remarks.js"></script>

    <!-- SWEETALERT2 JS CDN -->
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
            fetch('./scripts/export.php')
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
