<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../data/private/students.xml';

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

  <?php $currentPage = 'students'; ?>
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
          <h1 class="h3 mb-2 text-gray-800">Students</h1>
          <p class="mb-4">Review and manage enrolled students, including guardian information, academic status, and class details.</p>

          <!-- Data Table -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of Students</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-success">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Guardian Name</th>
                      <th>Guardian Contact No.</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="table-success">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Guardian Name</th>
                      <th>Guardian Contact No.</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($xml->student as $student): ?>
                      <tr>
                        <td><?= htmlspecialchars($student->id) ?></td>
                        <td><?= htmlspecialchars($student->name) ?></td>
                        <td><?= htmlspecialchars($student->guardian_name) ?></td>
                        <td><?= htmlspecialchars($student->guardian_contact) ?></td>
                        <td><?= htmlspecialchars($student->status) ?></td>
                        <td class="text-center" style="width: 75px; max-width: 75px;">
                          <a href="#" class="btn btn-info btn-sm edit-btn d-flex justify-content-center align-items-center"
                            data-id="<?= htmlspecialchars($student->id) ?>"
                            data-name="<?= htmlspecialchars($student->name) ?>"
                            data-guardian_name="<?= htmlspecialchars($student->guardian_name) ?>"
                            data-guardian_contact="<?= htmlspecialchars($student->guardian_contact) ?>"
                            data-status="<?= htmlspecialchars($student->status) ?>">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="#"
                            class="btn btn-danger btn-sm d-flex justify-content-center align-items-center delete-btn"
                            data-id="<?= htmlspecialchars($student->id) ?>">
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

        <!-- Add Student Modal -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form id="addStudentForm" class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addStudentLabel">Add Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="studentName">Name</label>
                  <input type="text" class="form-control" name="name" id="studentName" required>
                </div>
                <div class="form-group">
                  <label for="guardianName">Guardian Name</label>
                  <input type="text" class="form-control" name="guardian_name" id="guardianName" required>
                </div>
                <div class="form-group">
                  <label for="guardianContact">Guardian Contact</label>
                  <input type="text" class="form-control" name="guardian_contact" id="guardianContact" required>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" name="status" id="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Student</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Edit Student Modal -->
        <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form id="editStudentForm" class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editStudentLabel">Edit Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span>&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="editId">
                <div class="form-group">
                  <label for="editName">Name</label>
                  <input type="text" class="form-control" name="name" id="editName" required>
                </div>
                <div class="form-group">
                  <label for="editGuardianName">Guardian Name</label>
                  <input type="text" class="form-control" name="guardian_name" id="editGuardianName" required>
                </div>
                <div class="form-group">
                  <label for="editGuardianContact">Guardian Contact</label>
                  <input type="text" class="form-control" name="guardian_contact" id="editGuardianContact" required>
                </div>
                <div class="form-group">
                  <label for="editStatus">Status</label>
                  <select class="form-control" name="status" id="editStatus" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-info">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </form>
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

      // Populate Add Modal
      var addButton = $('<button>')
        .text('Add New')
        .addClass('btn btn-primary btn-sm ml-2')
        .attr('data-toggle', 'modal')
        .attr('data-target', '#addStudentModal');
      $('#dataTable_filter').append(addButton);

      // Submit Add Form
      $('#addStudentForm').on('submit', function(e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.post('scripts/add-students.php', formData, function(response) {
          if (response.trim() === 'success') {
            $('#addStudentModal').modal('hide');
            Swal.fire('Success', 'Student added successfully!', 'success').then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Error', response, 'error');
          }
        }).fail(function(xhr) {
          Swal.fire('Error', xhr.responseText || 'Something went wrong.', 'error');
        });
      });

      // Populate Edit Modal
      $(document).on('click', '.edit-btn', function() {
        $('#editId').val($(this).data('id'));
        $('#editName').val($(this).data('name'));
        $('#editGuardianName').val($(this).data('guardian_name'));
        $('#editGuardianContact').val($(this).data('guardian_contact'));
        $('#editStatus').val($(this).data('status'));
        $('#editStudentModal').modal('show');
      });

      // Submit Edit Form
      $('#editStudentForm').on('submit', function(e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.post('scripts/edit-students.php', formData, function(response) {
          if (response.trim() === 'success') {
            $('#editStudentModal').modal('hide');
            Swal.fire('Updated', 'Student updated successfully!', 'success').then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Error', response, 'error');
          }
        }).fail(function(xhr) {
          Swal.fire('Error', xhr.responseText || 'An error occurred.', 'error');
        });
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
    $(document).on('click', '.delete-btn', function(e) {
      e.preventDefault();

      const studentId = $(this).data('id');

      Swal.fire({
        title: 'Are you sure?',
        text: 'This action will archive the student record permanently.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.get(`scripts/delete-students.php?id=${encodeURIComponent(studentId)}`, function(response) {
            if (response.trim() === '' || response.trim() === 'success') {
              Swal.fire('Deleted!', 'Student has been removed.', 'success').then(() => {
                location.reload();
              });
            } else {
              Swal.fire('Error', response, 'error');
            }
          }).fail(function(xhr) {
            Swal.fire('Error', xhr.responseText || 'Failed to delete the student.', 'error');
          });
        }
      });
    });
  </script>
</body>

</html>
