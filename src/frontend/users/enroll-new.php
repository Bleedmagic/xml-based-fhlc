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
          <a href="enroll-current.php" class="btn-summary">Enroll Current Students</a>
          <a href="enroll-new.php" class="btn-summary">Enroll New Students</a>
        </div>

        <!-- Enrollment Form for Current Students -->
        <section class="fee-section">
          <h5>Current Student Enrollment Form</h5>
          <form action="dashboard.php" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">

            <!-- Student Full Name -->
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="lastName">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="lastName" name="last_name" value="Dela Cruz" placeholder="Enter Last Name" required>
                <div class="invalid-feedback">Please enter the last name.</div>
              </div>
              <div class="form-group col-md-4">
                <label for="firstName">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="firstName" name="first_name" value="Juan" placeholder="Enter First Name" required>
                <div class="invalid-feedback">Please enter the first name.</div>
              </div>
              <div class="form-group col-md-4">
                <label for="middleName">Middle Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="middleName" name="middle_name" value="Santos" placeholder="Enter Middle Name" required>
                <div class="invalid-feedback">Please enter the middle name.</div>
              </div>
            </div>

            <!-- Address -->
            <div class="form-group">
              <label for="address">Address <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="address" name="address" value="1234 Barangay Street, Mandaluyong City" placeholder="Complete Address" required>
              <div class="invalid-feedback">Please enter address.</div>
            </div>

            <!-- Age, Age in June, Birth Date, Birth Place -->
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="age">Age <span class="text-danger">*</span></label>
                <input type="number" min="1" max="20" class="form-control" id="age" name="age" value="10" placeholder="Age" required>
                <div class="invalid-feedback">Please enter age.</div>
              </div>
              <div class="form-group col-md-3">
                <label for="ageJune">Age in June <span class="text-danger">*</span></label>
                <input type="number" min="1" max="20" class="form-control" id="ageJune" name="age_in_june" value="11" placeholder="Age in June" required>
                <div class="invalid-feedback">Please enter age in June.</div>
              </div>
              <div class="form-group col-md-3">
                <label for="birthDate">Birth Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="birthDate" name="birth_date" value="2014-05-10" required>
                <div class="invalid-feedback">Please enter birth date.</div>
              </div>
              <div class="form-group col-md-4">
                <label for="birthPlace">Birth Place <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="birthPlace" name="birth_place" value="Mandaluyong City" placeholder="City/Municipality" required>
                <div class="invalid-feedback">Please enter birth place.</div>
              </div>
            </div>

            <!-- Religion, Gender, Weight, Height -->
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="religion">Religion <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="religion" name="religion" value="Roman Catholic" placeholder="Religion" required>
                <div class="invalid-feedback">Please enter religion.</div>
              </div>
              <div class="form-group col-md-3">
                <label for="gender">Gender <span class="text-danger">*</span></label>
                <select class="form-control" id="gender" name="gender" required>
                  <option value="" disabled>Choose...</option>
                  <option value="Male" selected>Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
                <div class="invalid-feedback">Please select gender.</div>
              </div>
              <div class="form-group col-md-3">
                <label for="weight">Weight (kg) <span class="text-danger">*</span></label>
                <input type="number" step="0.1" min="1" max="150" class="form-control" id="weight" name="weight" value="32.5" placeholder="Weight" required>
                <div class="invalid-feedback">Please enter weight.</div>
              </div>
              <div class="form-group col-md-3">
                <label for="height">Height (cm) <span class="text-danger">*</span></label>
                <input type="number" step="0.1" min="30" max="250" class="form-control" id="height" name="height" value="140.3" placeholder="Height" required>
                <div class="invalid-feedback">Please enter height.</div>
              </div>
            </div>

            <hr>

            <!-- Parent Information -->
            <h5>Parent Information</h5>

            <div class="form-row">
              <div class="form-group col-md-6">
                <h6>Father</h6>
                <input type="text" class="form-control mb-2" name="father_name" value="Carlos Dela Cruz" placeholder="Name" required>
                <input type="date" class="form-control mb-2" name="father_birth_date" value="1975-06-12" placeholder="Birth Date" required>
                <input type="text" class="form-control mb-2" name="father_tel_mobile" value="09171234567" placeholder="Tel. & Mobile No." required>
                <input type="text" class="form-control mb-2" name="father_religion" value="Roman Catholic" placeholder="Religion" required>
                <input type="text" class="form-control mb-2" name="father_occupation" value="Engineer" placeholder="Occupation" required>
                <input type="text" class="form-control mb-2" name="father_education" value="College Graduate" placeholder="Educational Attainment" required>
                <input type="email" class="form-control mb-2" name="father_email" value="carlos.delacruz@example.com" placeholder="Email Address" required>
              </div>
              <div class="form-group col-md-6">
                <h6>Mother</h6>
                <input type="text" class="form-control mb-2" name="mother_name" value="Maria Santos" placeholder="Name" required>
                <input type="date" class="form-control mb-2" name="mother_birth_date" value="1978-04-20" placeholder="Birth Date" required>
                <input type="text" class="form-control mb-2" name="mother_tel_mobile" value="09179876543" placeholder="Tel. & Mobile No." required>
                <input type="text" class="form-control mb-2" name="mother_religion" value="Roman Catholic" placeholder="Religion" required>
                <input type="text" class="form-control mb-2" name="mother_occupation" value="Teacher" placeholder="Occupation" required>
                <input type="text" class="form-control mb-2" name="mother_education" value="College Graduate" placeholder="Educational Attainment" required>
                <input type="email" class="form-control mb-2" name="mother_email" value="maria.santos@example.com" placeholder="Email Address" required>
              </div>
            </div>

            <hr>

            <!-- Student's Educational Background -->
            <h5>Student's Educational Background</h5>
            <div class="form-row align-items-center">
              <div class="form-group col-md-8">
                <label for="schoolName">School Name</label>
                <input type="text" class="form-control" id="schoolName" name="school_name" value="Full House Learning Center Inc." placeholder="School Name" required>
              </div>
              <div class="form-group col-md-2">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="preSchool" name="pre_school" value="1" checked>
                  <label class="form-check-label" for="preSchool">Pre-School</label>
                </div>
              </div>
              <div class="form-group col-md-2">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="elementary" name="elementary" value="1" checked>
                  <label class="form-check-label" for="elementary">Elementary</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="schoolAddress">School Address</label>
              <input type="text" class="form-control" id="schoolAddress" name="school_address" value="858 Mansanas St. NAPICO, Mangagahan Pasig City" placeholder="School Address" required>
            </div>
            <div class="form-group">
              <label for="languageHome">Language Spoken at Home</label>
              <input type="text" class="form-control" id="languageHome" name="language_spoken_home" value="Tagalog, English" placeholder="Language Spoken at Home" required>
            </div>

            <hr>

            <!-- Emergency Contact -->
            <h5>In Case of Emergency Contact</h5>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="guardianName">Guardian Name</label>
                <input type="text" class="form-control" id="guardianName" name="guardian_name" value="Pedro Dela Cruz" placeholder="Guardian Name" required>
              </div>
              <div class="form-group col-md-6">
                <label for="contactNumber">Contact Number</label>
                <input type="text" class="form-control" id="contactNumber" name="guardian_contact_number" value="09171234569" placeholder="Contact Number" required>
              </div>
            </div>
            <div class="form-group">
              <label for="guardianAddress">Guardian Address</label>
              <input type="text" class="form-control" id="guardianAddress" name="guardian_address" value="1234 Barangay Street, Mandaluyong City" placeholder="Guardian Address" required>
            </div>
            <div class="form-group">
              <label for="guardianEmail">Guardian Email Address</label>
              <input type="email" class="form-control" id="guardianEmail" name="guardian_email" value="pedro.delacruz@example.com" placeholder="Guardian Email" required>
            </div>
            <div class="form-group">
              <label for="guardianOccupation">Guardian Occupation</label>
              <input type="text" class="form-control" id="guardianOccupation" name="guardian_occupation" value="Uncle" placeholder="Guardian Occupation" required>
            </div>

            <hr>

            <!-- How did you know our school? -->
            <h5>How did you know our school? <span class="text-danger">*</span></h5>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="fliers" name="source[]" value="Fliers" checked>
              <label class="form-check-label" for="fliers">Fliers</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="posters" name="source[]" value="Posters">
              <label class="form-check-label" for="posters">Posters</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="facebook" name="source[]" value="Facebook" checked>
              <label class="form-check-label" for="facebook">Facebook</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="mobile" name="source[]" value="Mobile">
              <label class="form-check-label" for="mobile">Mobile</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="website" name="source[]" value="Website" checked>
              <label class="form-check-label" for="website">Website</label>
            </div>
            <div class="form-group mt-2">
              <label for="referredBy">Referred By (if any)</label>
              <input type="text" class="form-control" id="referredBy" name="referred_by" value="Friend John" placeholder="Referred by">
            </div>

            <hr>

            <!-- Grade Level and School Year -->
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="gradeLevel">Grade Level to Enroll <span class="text-danger">*</span></label>
                <select class="form-control" id="gradeLevel" name="grade_level" required>
                  <option value="" disabled>Choose...</option>
                  <option value="Kinder 1" <?php echo (isset($_POST['grade_level']) && $_POST['grade_level'] == "Kinder 1") ? 'selected' : ''; ?>>Kinder 1</option>
                  <option value="Kinder 2" <?php echo (isset($_POST['grade_level']) && $_POST['grade_level'] == "Kinder 2") ? 'selected' : ''; ?>>Kinder 2</option>
                  <option value="Grade 1" selected>Grade 1</option>
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

            <hr>

            <div class="form-group">
              <label for="paymentOption">Payment Option <span class="text-danger">*</span></label>
              <select class="form-control" id="paymentOption" name="payment_option" required>
                <option value="" disabled>Choose payment option</option>
                <option value="Annual" selected>Annual</option>
                <option value="Semi-Annual">Semi-Annual</option>
                <option value="Quarterly">Quarterly</option>
                <option value="Monthly">Monthly</option>
              </select>
              <div class="invalid-feedback">Please select a payment option.</div>
            </div>

            <!-- Additional required uploads -->
            <div class="form-group upload-group" id="uploadReportCard">
              <label for="reportCard" class="font-weight-bold">
                Original Form 138 (Report Card) <span class="text-danger">*</span><br>
                <small class="text-muted">Must be submitted or uploaded to show the student’s final grades from the previous school year.</small>
              </label>
              <input type="file" class="form-control-file" id="reportCard" name="report_card" accept=".pdf,.jpg,.jpeg,.png" required>
              <div class="invalid-feedback">Please upload the Report Card (Form 138).</div>
            </div>

            <div class="form-group upload-group" id="uploadBirthCert">
              <label for="birthCert" class="font-weight-bold">
                Photocopy of Birth Certificate <span class="text-danger">*</span>
              </label>
              <input type="file" class="form-control-file" id="birthCert" name="birth_certificate" accept=".pdf,.jpg,.jpeg,.png" required>
              <div class="invalid-feedback">Please upload the Birth Certificate.</div>
            </div>

            <div class="form-group upload-group" id="uploadBaptismalCert">
              <label for="baptismalCert" class="font-weight-bold">
                Photocopy of Baptismal or Dedication Certificate <span class="text-danger">*</span>
              </label>
              <input type="file" class="form-control-file" id="baptismalCert" name="baptismal_certificate" accept=".pdf,.jpg,.jpeg,.png" required>
              <div class="invalid-feedback">Please upload the Baptismal or Dedication Certificate.</div>
            </div>

            <!-- Only for Elementary -->
            <div class="form-group upload-group" id="uploadGoodMoral" style="display:none;">
              <label for="goodMoral" class="font-weight-bold">
                Good Moral Certificate <span class="text-danger">*</span><br>
                <small class="text-muted">Usually issued by the class adviser or guidance office.</small>
              </label>
              <input type="file" class="form-control-file" id="goodMoral" name="good_moral" accept=".pdf,.jpg,.jpeg,.png">
              <div class="invalid-feedback">Please upload the Good Moral Certificate.</div>
            </div>

            <div class="form-group upload-group" id="uploadForm137" style="display:none;">
              <label for="form137" class="font-weight-bold">
                Form 137 (Permanent Record) <span class="text-danger">*</span>
              </label>
              <input type="file" class="form-control-file" id="form137" name="form_137" accept=".pdf,.jpg,.jpeg,.png">
              <div class="invalid-feedback">Please upload the Form 137 (Permanent Record).</div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form.needs-validation");
  const submitBtn = document.getElementById("submitBtn");

  // Grade level select and upload inputs
  const gradeLevelSelect = document.getElementById("gradeLevel");
  const goodMoralGroup = document.getElementById("uploadGoodMoral");
  const form137Group = document.getElementById("uploadForm137");
  const goodMoralInput = document.getElementById("goodMoral");
  const form137Input = document.getElementById("form137");

  function isPreschool(grade) {
    return grade === "Kinder 1" || grade === "Kinder 2";
  }

  function updateUploads() {
    const selectedGrade = gradeLevelSelect.value;

    if (isPreschool(selectedGrade)) {
      goodMoralGroup.style.display = "none";
      form137Group.style.display = "none";

      goodMoralInput.required = false;
      form137Input.required = false;
    } else {
      goodMoralGroup.style.display = "block";
      form137Group.style.display = "block";

      goodMoralInput.required = true;
      form137Input.required = true;
    }
  }

  // Initialize upload inputs based on current grade level selection
  updateUploads();

  // Listen for changes in grade level
  gradeLevelSelect.addEventListener("change", updateUploads);

  if (form && submitBtn) {
    form.addEventListener("submit", function (e) {
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
          Swal.fire({
            icon: 'info',
            title: 'Enrollment Submitted',
            text: 'Your enrollment has been submitted. The admin will review it and send confirmation via email.',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false
          }).then(() => {
            form.submit();
          });
        }
      });
    });
  }
});
</script>

</body>
</html>
