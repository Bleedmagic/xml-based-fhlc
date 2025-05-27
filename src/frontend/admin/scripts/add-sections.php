<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/sections.xml';

$error = '';
// Preserve inputs on error
$inputs = ['name' => '', 'grade_level' => '', 'adviser' => '', 'number_of_students' => '', 'schedule' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitize and trim inputs
  $inputs['name'] = trim($_POST['name'] ?? '');
  $inputs['grade_level'] = trim($_POST['grade_level'] ?? '');
  $inputs['adviser'] = trim($_POST['adviser'] ?? '');
  $inputs['number_of_students'] = trim($_POST['number_of_students'] ?? '');
  $inputs['schedule'] = trim($_POST['schedule'] ?? '');

  if (in_array('', $inputs, true)) {
    $error = 'All fields are required.';
  } elseif (!ctype_digit($inputs['number_of_students']) || (int)$inputs['number_of_students'] < 0) {
    $error = 'Number of Students must be a non-negative integer.';
  } else {
    if (file_exists($xmlPath)) {
      libxml_use_internal_errors(true);
      $xml = simplexml_load_file($xmlPath);
      if ($xml === false) {
        $error = 'Failed to parse XML file. Please contact the administrator.';
      }
      libxml_clear_errors();
    } else {
      $xml = new SimpleXMLElement('<sections></sections>');
    }

    if (!$error) {
      // Generate new ID (max existing + 1)
      $ids = [];
      foreach ($xml->section as $section) {
        $ids[] = (int)$section->id;
      }
      $newId = empty($ids) ? 1 : max($ids) + 1;

      $section = $xml->addChild('section');
      $section->addChild('id', $newId);
      $section->addChild('name', $inputs['name']);
      $section->addChild('grade_level', $inputs['grade_level']);
      $section->addChild('adviser', $inputs['adviser']);
      $section->addChild('number_of_students', $inputs['number_of_students']);
      $section->addChild('schedule', $inputs['schedule']);

      $xml->asXML($xmlPath);

      header('Location: ../sections.php');
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Section</title>
</head>

<body>
  <h2>Add New Section</h2>
  <?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="POST" action="">
    <label>Section Name:<br>
      <input type="text" name="name" value="<?= htmlspecialchars($inputs['name']) ?>" required>
    </label><br><br>

    <label>Grade Level:<br>
      <select name="grade_level" required>
        <option value="">Select Grade</option>
        <?php
        $grades = ['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6'];
        foreach ($grades as $grade) {
          $selected = ($inputs['grade_level'] === $grade) ? 'selected' : '';
          echo "<option value=\"$grade\" $selected>$grade</option>";
        }
        ?>
      </select>
    </label><br><br>

    <label>Adviser:<br>
      <input type="text" name="adviser" value="<?= htmlspecialchars($inputs['adviser']) ?>" required>
    </label><br><br>

    <label>Number of Students:<br>
      <input type="number" name="number_of_students" min="0" step="1" value="<?= htmlspecialchars($inputs['number_of_students']) ?>" required>
    </label><br><br>

    <label>Schedule:<br>
      <input type="text" name="schedule" value="<?= htmlspecialchars($inputs['schedule']) ?>" required>
    </label><br><br>

    <button type="submit">Add</button>
    <a href="../sections.php">Cancel</a>
  </form>
</body>

</html>
