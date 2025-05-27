<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guardian') {
  header('Location: ../auth/login.php');
  exit();
}
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

          <!-- Enrollment Form for Current Students -->
          <section class="fee-section">
            <h5>Current Student Enrollment Form</h5>
            <form action="dashboard.php" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="studentID">Student ID <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="studentID" name="student_id" placeholder="Enter Student ID" required>
                  <div class="invalid-feedback">Please enter your Student ID.</div>
                </div>
              </div>

              <!-- Student Full Name split -->
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="lastName">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter Last Name" required>
                  <div class="invalid-feedback">Please enter the last name.</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="firstName">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter First Name" required>
                  <div class="invalid-feedback">Please enter the first name.</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="middleName">Middle Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="middleName" name="middle_name" placeholder="Enter Middle Name" required>
                  <div class="invalid-feedback">Please enter the middle name.</div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="gradeLevel">Grade Level to Enroll <span class="text-danger">*</span></label>
                  <select class="form-control" id="gradeLevel" name="grade_level" required>
                    <option value="" disabled selected>Choose...</option>
                    <option value="Kinder 1">Kinder 1</option>
                    <option value="Kinder 2">Kinder 2</option>
                    <option value="Grade 1">Grade 1</option>
                    <option value="Grade 2">Grade 2</option>
                    <option value="Grade 3">Grade 3</option>
                    <option value="Grade 4">Grade 4</option>
                    <option value="Grade 5">Grade 5</option>
                    <option value="Grade 6">Grade 6</option>
                  </select>
                  <div class="invalid-feedback">Please select your grade level.</div>
                </div>
                <div class="form-group col-md-6">
                  <label for="enrollmentYear">School Year <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="enrollmentYear" name="school_year" value="2025-2026" readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="paymentOption">Payment Option <span class="text-danger">*</span></label>
                <select class="form-control" id="paymentOption" name="payment_option" required>
                  <option value="" disabled selected>Choose payment option</option>
                  <option value="Annual">Annual</option>
                  <option value="Semi-Annual">Semi-Annual</option>
                  <option value="Quarterly">Quarterly</option>
                  <option value="Monthly">Monthly</option>
                </select>
                <div class="invalid-feedback">Please select a payment option.</div>
              </div>

              <!-- Requirements Upload Section -->
              <div class="form-group">
                <label>Upload Required Documents <small class="text-muted">(PDF, JPG, PNG; Max size: 5MB each)</small> <span class="text-danger">*</span></label>

                <div class="mb-3">
                  <label for="reportCard" class="font-weight-bold">
                    Report Card (Form 138) <span class="text-danger">*</span><br>
                    <small class="text-muted">
                      Must be submitted or uploaded to show the student’s final grades from the previous school year.
                    </small>
                  </label>
                  <input type="file" class="form-control-file" id="reportCard" name="report_card" required accept=".pdf,.jpg,.jpeg,.png">
                  <div class="invalid-feedback">Please upload the Report Card (Form 138).</div>
                </div>

                <div class="mb-3">
                  <label for="clearance" class="font-weight-bold">
                    Updated School Fees or Clearance (if applicable) <span class="text-danger">*</span><br>
                    <small class="text-muted">
                      Proof of no pending obligations (for private schools).
                    </small>
                  </label>
                  <input type="file" class="form-control-file" id="clearance" name="clearance" required accept=".pdf,.jpg,.jpeg,.png">
                  <div class="invalid-feedback">Please upload the updated school fees receipt or clearance.</div>
                </div>

                <div class="mb-3">
                  <label for="goodMoral" class="font-weight-bold">
                    Certificate of Good Moral Character (if requested)<br>
                    <small class="text-muted">
                      Usually issued by the class adviser or guidance office. Required mainly for upper grades.
                    </small>
                  </label>
                  <input type="file" class="form-control-file" id="goodMoral" name="good_moral" accept=".pdf,.jpg,.jpeg,.png">
                </div>
              </div>

              <div class="text-right mt-3 mb-3 mr-3">
                <button type="submit" id="submitBtn" class="btn btn-primary">Submit Enrollment</button>
              </div>
            </form>
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>4
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const form = document.querySelector("form.needs-validation");
      const submitBtn = document.getElementById("submitBtn");

      if (form && submitBtn) {
        form.addEventListener("submit", function(e) {
          e.preventDefault();

          if (!form.checkValidity()) {
            form.classList.add("was-validated");
            return;
          }

          Swal.fire({
            title: 'Submit Enrollment?',
            text: 'Are you sure you want to submit your enrollment application?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit',
            cancelButtonText: 'Cancel',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              // Show second popup with info message
              Swal.fire({
                icon: 'info',
                title: 'Enrollment Submitted',
                text: 'Your enrollment has been submitted. The admin will review it and send confirmation via email.',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false
              }).then(() => {
                form.submit(); // submit after user clicks OK
              });
            }
          });
        });
      }
    });
  </script>




</body>

</html>
