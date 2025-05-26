<?php
session_start();

if (!isset($_GET['id']) || !isset($_SESSION['complaints'][$_GET['id']])) {
    echo "Invalid or missing complaint ID.";
    exit;
}

$id = $_GET['id'];
$entry = $_SESSION['complaints'][$id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Complaint/Request</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png" sizes="180x180" />
  <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />
  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../assets/css/add-complaints-request.css">
</head>

<body id="page-top">
<div id="wrapper">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php include __DIR__ . '/partials/topbar.php'; ?>

      <div class="container-fluid complaints-form">
        <h4 class="section-title">Edit Complaint/Request</h4>

        <form action="update-complaints-request.php" method="POST">
          <input type="hidden" name="id" value="<?= $id ?>">

          <div class="form-group">
            <label class="form-label">Type of Concern</label>
            <div class="radio-group">
              <label><input type="radio" name="type" value="Complain" <?= $entry['type'] === 'Complain' ? 'checked' : '' ?> required> Complain</label>
              <label><input type="radio" name="type" value="Request" <?= $entry['type'] === 'Request' ? 'checked' : '' ?> required> Request</label>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Date of Incident</label>
            <input type="date" name="incident_date" class="input-text" value="<?= htmlspecialchars($entry['date']) ?>" required>
          </div>

          <div class="form-group">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="input-text" value="<?= htmlspecialchars($entry['subject']) ?>" required>
          </div>

          <div class="form-group">
            <label class="form-label">Message</label>
            <textarea name="message" rows="5" required><?= isset($entry['message']) ? htmlspecialchars($entry['message']) : '' ?></textarea>
          </div>

          <div class="button-group">
            <button type="submit" class="submit-btn">Update</button>
            <a href="complaints-requests.php" class="cancel-btn">Cancel</a>
          </div>
        </form>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Update Complaint/Request?',
      text: 'Are you sure you want to update this entry?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, update',
      cancelButtonText: 'Cancel',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
});
</script>
</body>
</html>
