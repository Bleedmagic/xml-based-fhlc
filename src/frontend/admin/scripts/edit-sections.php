<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/sections.xml';

if (!isset($_GET['id'])) {
  header('Location: ../sections.php');
  exit();
}

$id = (int)$_GET['id'];

if (!file_exists($xmlPath)) {
  die('XML file not found.');
}

libxml_use_internal_errors(true);
$xml = simplexml_load_file($xmlPath);
if ($xml === false) {
  die('Failed to parse XML file.');
}
libxml_clear_errors();

$sectionToEdit = null;
foreach ($xml->section as $section) {
  if ((int)$section->id === $id) {
    $sectionToEdit = $section;
    break;
  }
}

if (!$sectionToEdit) {
  die('Section not found.');
}

$error = '';
// Store inputs for form repopulation
$inputs = [
  'name' => (string)$sectionToEdit->name,
  'grade_level' => (string)$sectionToEdit->grade_level,
  'adviser' => (string)$sectionToEdit->adviser,
  'number_of_students' => (string)$sectionToEdit->number_of_students,
  'schedule' => (string)$sectionToEdit->schedule,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $sectionToEdit->name = $inputs['name'];
    $sectionToEdit->grade_level = $inputs['grade_level'];
    $sectionToEdit->adviser = $inputs['adviser'];
    $sectionToEdit->number_of_students = $inputs['number_of_students'];
    $sectionToEdit->schedule = $inputs['schedule'];

    $xml->asXML($xmlPath);

    header('Location: ../sections.php');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit Section</title>
</head>

<body>
  <h2>Edit Section</h2>
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

    <button type="submit">Save Changes</button>
    <a href="../sections.php">Cancel</a>
  </form>
</body>

</html>
