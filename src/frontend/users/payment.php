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
  <link rel="stylesheet" href="../../../assets/css/payment.css">
  
</head>

<body id="page-top">
<div id="wrapper">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Back Button -->
    <a href="payment-enrollment.php" class="back-link">
      <i class="fas fa-arrow-left"></i> 
    </a>

    <!-- Start content -->
    <div class="container-fluid py-4">
      <h4 class="payment-heading">Payment Details</h4>
      <form class="payment-form">
    <form class="payment-form" method="post" enctype="multipart/form-data">
      <!-- Full Name Row -->
      <div class="form-group-row">
        <label>Student Full Name:</label>
        <div class="row">
          <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
          </div>
          <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" required>
          </div>
          <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
          </div>
        </div>
      </div>

      <!-- ID / Payment Type / Paid -->
      <div class="form-group-row">
        <div class="row">
          <div class="col-md-4 mb-2">
            <label>Student ID:</label>
            <input type="number" class="form-control" id="student_id" name="student_id" required min="0" step="1" placeholder="Enter Student ID (numbers only)">
          </div>
          <div class="col-md-4 mb-2">
            <label>Payment Type:</label>
            <select class="form-control" name="payment_type" required>
              <option disabled selected value="">Select Payment Type</option>
              <option value="annual">Annual – Full at start, may include 5–10% discount</option>
              <option value="semi">Semi-Annual – Two payments: Start & Nov/Dec</option>
              <option value="quarterly">Quarterly – Four payments across the year</option>
              <option value="monthly">Monthly – 10–12 installments, flexible</option>
            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label>Amount Already Paid:</label>
            <input type="number" class="form-control" id="amount_paid" name="amount_paid" required min="0" step="0.01" placeholder="Enter amount (numbers only)">
          </div>
        </div>
      </div>

      <!-- Balance / Due Date -->
      <div class="form-group-row">
        <div class="row">
          <div class="col-md-6 mb-2">
            <label>Balance to Pay:</label>
            <input type="number" class="form-control" id="balance" name="balance" required min="0" step="0.01" placeholder="Enter balance (numbers only)">
          </div>
          <div class="col-md-6 mb-2">
            <label>Due Date:</label>
            <input type="date" class="form-control" name="due_date" required>
          </div>

        </div>
      </div>

      <!-- Mode of Payment & Proof Upload -->
<div class="form-group-row mt-3">
  <div class="row">
    <div class="col-md-6 mb-2">
      <label>Mode of Payment:</label>
      <select class="form-control" name="mode_of_payment" required>
        <option disabled selected value="">Select Mode</option>
        <option value="gcash">GCash</option>
        <option value="bank">Bank Transfer</option>
        <option value="credit">Credit/Debit Card</option>
      </select>
    </div>
    <div class="col-md-6 mb-2">
      <label>Upload Proof of Payment (Image):</label>
      <input type="file" class="form-control" name="receipt_image" accept="image/*" required>
    </div>
  </div>
</div>


      <!-- Submit Button -->
      <div class="form-row mt-4 d-flex justify-content-end">
        <button class="btn btn-warning proceed-btn" type="submit">
          Submit 
        </button>
      </div>
    </form>

    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>
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
  document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('keydown', function (e) {
      // Allow: backspace, delete, tab, escape, enter, arrows
      if ([46, 8, 9, 27, 13, 37, 38, 39, 40].includes(e.keyCode)) {
        return;
      }

      // Prevent: e, +, - from being typed
      if (["e", "E", "+", "-"].includes(e.key)) {
        e.preventDefault();
      }
    });
  });

  document.querySelector('.payment-form').addEventListener('submit', function (e) {
  e.preventDefault(); // prevent real submission temporarily

  Swal.fire({
    icon: 'success',
    title: 'Submission Received',
    text: 'Your payment will be checked by the admin. Please wait for confirmation.',
    confirmButtonColor: '#1A906B'
  });
});

</script>


</body>
</html>
