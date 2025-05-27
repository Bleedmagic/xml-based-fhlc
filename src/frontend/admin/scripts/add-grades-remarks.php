<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/grades-remarks.xml';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate and sanitize input
  $name = trim($_POST['name'] ?? '');
  $grade_level = trim($_POST['grade_level'] ?? '');
  $general_average = trim($_POST['general_average'] ?? '');
  $remarks = trim($_POST['remarks'] ?? '');
  $baseId = trim($_POST['base_id'] ?? '485563'); // Add base_id field in form or hardcode

  if ($name === '' || $grade_level === '' || $general_average === '' || $remarks === '') {
    $error = 'All fields are required.';
  } elseif (!is_numeric($general_average) || $general_average < 0 || $general_average > 100) {
    $error = 'General Average must be a number between 0 and 100.';
  } else {
    // Load or create XML
    if (file_exists($xmlPath)) {
      $xml = simplexml_load_file($xmlPath);
      if ($xml === false) {
        die('Failed to parse XML file.');
      }
    } else {
      $xml = new SimpleXMLElement('<grades-remarks></grades-remarks>');
    }

    // Collect existing sequence numbers for this baseId
    $existingSeq = [];
    foreach ($xml->student as $student) {
      $idParts = explode('-', (string)$student->id);
      if ($idParts[0] === $baseId && isset($idParts[1])) {
        $existingSeq[] = (int)$idParts[1];
      }
    }

    // Calculate new sequence number and format new ID
    $newSeq = empty($existingSeq) ? 1 : max($existingSeq) + 1;
    $newId = sprintf('%s-%03d', $baseId, $newSeq);

    // Add new student element
    $student = $xml->addChild('student');
    $student->addChild('id', $newId);
    $student->addChild('name', htmlspecialchars($name, ENT_QUOTES, 'UTF-8'));
    $student->addChild('grade_level', htmlspecialchars($grade_level, ENT_QUOTES, 'UTF-8'));
    $student->addChild('general_average', htmlspecialchars($general_average, ENT_QUOTES, 'UTF-8'));
    $student->addChild('remarks', htmlspecialchars($remarks, ENT_QUOTES, 'UTF-8'));

    // Save XML
    $xml->asXML($xmlPath);

    header('Location: ../grades-remarks.php');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Grade Remark</title>
</head>

<body>
  <h2>Add New Grade Remark</h2>
  <?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="POST" action="">
    <label>Name:<br><input type="text" name="name" required></label><br><br>
    <label>Grade Level:<br><input type="text" name="grade_level" required></label><br><br>
    <label>General Average:<br><input type="number" name="general_average" min="0" max="100" step="0.01" required></label><br><br>
    <label>Remarks:<br><input type="text" name="remarks" required></label><br><br>
    <label>Base ID:<br><input type="text" name="base_id" value="485563" required></label><br><br> <!-- optional -->
    <button type="submit">Add</button>
    <a href="../grades-remarks.php">Cancel</a>
  </form>
</body>

</html>
