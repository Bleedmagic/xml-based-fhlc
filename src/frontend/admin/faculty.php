<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../data/private/faculty.xml';

if (file_exists($xmlPath)) {
  $xml = simplexml_load_file($xmlPath);
  if ($xml === false) {
    die('Failed to parse XML file.');
  }
} else {
  die('XML file not found at path: ' . $xmlPath);
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

  <?php $currentPage = 'faculty'; ?>
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
  <link href="../../../assets/css/lib/dataTables.bootstrap4.min.css" rel="stylesheet">

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
          <h1 class="h3 mb-2 text-gray-800">Faculty</h1>
          <p class="mb-4">Review and manage information about faculty members, including their subjects, grade levels, and employment type.</p>

          <!-- Data Table -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of Faculty Members</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-success">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Subjects Handled</th>
                      <th>Grade Levels</th>
                      <th>Type</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="table-success">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Subjects Handled</th>
                      <th>Grade Levels</th>
                      <th>Type</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($xml->teachers->teacher as $teacher): ?>
                      <tr>
                        <td><?= htmlspecialchars($teacher->id) ?></td>
                        <td><?= htmlspecialchars($teacher->name) ?></td>
                        <td><?= htmlspecialchars($teacher->subject_handled) ?></td>
                        <td><?= htmlspecialchars($teacher->grade_levels) ?></td>
                        <td><?= htmlspecialchars($teacher->type) ?></td>
                        <td class="text-center" style="width: 75px; max-width: 75px;">
                          <a href="#"
                            class="btn btn-info btn-sm edit-btn d-flex justify-content-center align-items-center"
                            data-toggle="modal"
                            data-target="#editFacultyModal"
                            data-id="<?= htmlspecialchars($teacher->id) ?>"
                            data-name="<?= htmlspecialchars($teacher->name) ?>"
                            data-subject="<?= htmlspecialchars($teacher->subject_handled) ?>"
                            data-grades="<?= htmlspecialchars($teacher->grade_levels) ?>"
                            data-type="<?= htmlspecialchars($teacher->type) ?>">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="#"
                            class="btn btn-danger btn-sm delete-btn d-flex justify-content-center align-items-center"
                            data-id="<?= htmlspecialchars($teacher->id) ?>"
                            data-name="<?= htmlspecialchars($teacher->name) ?>">
                            <i class="fas fa-archive"></i>
                          </a>
                        </td>

                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="mt-2 mb-4 text-center small">
              <span>Table loaded via DataTables</span>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Add Faculty Modal -->
        <div class="modal fade" id="addFacultyModal" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="scripts/add-faculty.php" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title" id="addFacultyLabel">Add New Faculty</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="facultyName">Name</label>
                    <input type="text" class="form-control" id="facultyName" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="facultySubject">Subjects Handled</label>
                    <input type="text" class="form-control" id="facultySubject" name="subject_handled" required>
                  </div>
                  <div class="form-group">
                    <label for="facultyGrades">Grade Levels</label>
                    <input type="text" class="form-control" id="facultyGrades" name="grade_levels" required>
                  </div>
                  <div class="form-group">
                    <label for="facultyType">Type</label>
                    <input type="text" class="form-control" id="facultyType" name="type" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Add Faculty</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Edit Faculty Modal -->
        <div class="modal fade" id="editFacultyModal" tabindex="-1" aria-labelledby="editFacultyLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form id="editFacultyForm" action="scripts/edit-faculty.php" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title" id="editFacultyLabel">Edit Faculty</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="id" id="editFacultyId">
                  <div class="form-group">
                    <label for="editFacultyName">Name</label>
                    <input type="text" class="form-control" id="editFacultyName" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="editFacultySubject">Subjects Handled</label>
                    <input type="text" class="form-control" id="editFacultySubject" name="subject_handled" required>
                  </div>
                  <div class="form-group">
                    <label for="editFacultyGrades">Grade Levels</label>
                    <input type="text" class="form-control" id="editFacultyGrades" name="grade_levels" required>
                  </div>
                  <div class="form-group">
                    <label for="editFacultyType">Type</label>
                    <input type="text" class="form-control" id="editFacultyType" name="type" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>

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
  <!-- -------------- -->

  <!-- DataTables JS -->
  <script src="../../../assets/js/lib/jquery.dataTables.min.js"></script>
  <script src="../../../assets/js/lib/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
      var table = $('#dataTable').DataTable({
        columnDefs: [{
          orderable: false,
          targets: -1
        }]
      });

      var addButton = $('<button>')
        .text('Add New')
        .addClass('btn btn-primary btn-sm ml-2')
        .attr({
          'data-toggle': 'modal',
          'data-target': '#addFacultyModal'
        });
      $('#dataTable_filter').append(addButton);

      // Populate edit modal
      $('#dataTable').on('click', '.edit-btn', function() {
        const btn = $(this);
        $('#editFacultyId').val(btn.data('id'));
        $('#editFacultyName').val(btn.data('name'));
        $('#editFacultySubject').val(btn.data('subject'));
        $('#editFacultyGrades').val(btn.data('grades'));
        $('#editFacultyType').val(btn.data('type'));
      });

      // Populate delete modal
      $('#dataTable').on('click', '.delete-btn', function() {
        const btn = $(this);
        $('#deleteFacultyId').val(btn.data('id'));
        $('#deleteFacultyName').text(btn.data('name'));
      });
    });
  </script>

  <!-- SweetAlert2 JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    // Export
    const currentPage = <?php echo json_encode($currentPage); ?>;

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
          fetch('scripts/export.php?page=' + encodeURIComponent(currentPage))
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

    // Delete
    $('#dataTable').on('click', '.delete-btn', function(e) {
      e.preventDefault();

      const btn = $(this);
      const facultyId = btn.data('id');
      const facultyName = btn.data('name');

      Swal.fire({
        title: 'Delete Faculty',
        html: `Are you sure you want to delete <strong>${facultyName}</strong>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          // Create and submit a hidden form
          const form = $('<form>', {
            method: 'POST',
            action: 'scripts/delete-faculty.php'
          }).append($('<input>', {
            type: 'hidden',
            name: 'id',
            value: facultyId
          }));

          $('body').append(form);
          form.submit();
        }
      });
    });
  </script>
</body>

</html>
