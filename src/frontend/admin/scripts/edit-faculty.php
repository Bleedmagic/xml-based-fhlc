<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/faculty.xml';
$id = $_GET['id'] ?? '';

if (!file_exists($xmlPath)) {
  die('XML file not found.');
}

$xml = simplexml_load_file($xmlPath);
$teacher = null;

foreach ($xml->teachers->teacher as $t) {
  if ((string)$t->id === $id) {
    $teacher = $t;
    break;
  }
}

if (!$teacher) {
  die('Teacher not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $teacher->name = $_POST['name'];
  $teacher->subject_handled = $_POST['subject_handled'];
  $teacher->grade_levels = $_POST['grade_levels'];
  $teacher->type = $_POST['type'];

  $xml->asXML($xmlPath);
  header('Location: ../faculty.php');
  exit();
}
?>

<form method="POST" action="">
  <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($teacher->name) ?>" required></label><br>
  <label>Subjects Handled: <input type="text" name="subject_handled" value="<?= htmlspecialchars($teacher->subject_handled) ?>" required></label><br>
  <label>Grade Levels: <input type="text" name="grade_levels" value="<?= htmlspecialchars($teacher->grade_levels) ?>" required></label><br>
  <label>Type: <input type="text" name="type" value="<?= htmlspecialchars($teacher->type) ?>" required></label><br>
  <button type="submit">Save Changes</button>
</form>
