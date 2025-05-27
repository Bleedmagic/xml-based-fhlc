<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/grades-remarks.xml';

if (!isset($_GET['id'])) {
  header('Location: ../grades-remarks.php');
  exit();
}

$id = (int)$_GET['id'];

if (!file_exists($xmlPath)) {
  die('XML file not found.');
}

$xml = simplexml_load_file($xmlPath);
if ($xml === false) {
  die('Failed to parse XML file.');
}

// Find the student to edit
$studentToEdit = null;
foreach ($xml->student as $student) {
  if ((int)$student->id === $id) {
    $studentToEdit = $student;
    break;
  }
}

if (!$studentToEdit) {
  die('Student record not found.');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate and sanitize input
  $name = trim($_POST['name'] ?? '');
  $grade_level = trim($_POST['grade_level'] ?? '');
  $general_average = trim($_POST['general_average'] ?? '');
  $remarks = trim($_POST['remarks'] ?? '');

  if ($name === '' || $grade_level === '' || $general_average === '' || $remarks === '') {
    $error = 'All fields are required.';
  } elseif (!is_numeric($general_average) || $general_average < 0 || $general_average > 100) {
    $error = 'General Average must be a number between 0 and 100.';
  } else {
    // Update XML node
    $studentToEdit->name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $studentToEdit->grade_level = htmlspecialchars($grade_level, ENT_QUOTES, 'UTF-8');
    $studentToEdit->general_average = htmlspecialchars($general_average, ENT_QUOTES, 'UTF-8');
    $studentToEdit->remarks = htmlspecialchars($remarks, ENT_QUOTES, 'UTF-8');

    $xml->asXML($xmlPath);

    header('Location: ../grades-remarks.php');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit Grade Remark</title>
  <!-- Add your CSS/JS includes here -->
</head>

<body>
  <h2>Edit Grade Remark</h2>
  <?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="POST" action="">
    <label>Name:<br><input type="text" name="name" value="<?= htmlspecialchars($studentToEdit->name) ?>" required></label><br><br>
    <label>Grade Level:<br><input type="text" name="grade_level" value="<?= htmlspecialchars($studentToEdit->grade_level) ?>" required></label><br><br>
    <label>General Average:<br><input type="number" name="general_average" min="0" max="100" step="0.01" value="<?= htmlspecialchars($studentToEdit->general_average) ?>" required></label><br><br>
    <label>Remarks:<br><input type="text" name="remarks" value="<?= htmlspecialchars($studentToEdit->remarks) ?>" required></label><br><br>
    <button type="submit">Save Changes</button>
    <a href="../grades-remarks.php">Cancel</a>
  </form>
</body>

</html>
