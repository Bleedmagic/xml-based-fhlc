<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/students.xml';
$id = $_GET['id'] ?? '';

if (!file_exists($xmlPath)) {
  die('XML file not found.');
}

$xml = simplexml_load_file($xmlPath);
$student = null;

foreach ($xml->student as $s) {
  if ((string)$s->id === $id) {
    $student = $s;
    break;
  }
}

if (!$student) {
  die('Student not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $student->name = $_POST['name'];
  $student->guardian_name = $_POST['guardian_name'];
  $student->guardian_contact = $_POST['guardian_contact'];
  $student->status = $_POST['status'];

  $xml->asXML($xmlPath);
  header('Location: ../students.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit Student</title>
</head>

<body>
  <h2>Edit Student</h2>
  <form method="POST" action="">
    <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($student->name) ?>" required></label><br>
    <label>Guardian Name: <input type="text" name="guardian_name" value="<?= htmlspecialchars($student->guardian_name) ?>" required></label><br>
    <label>Guardian Contact: <input type="text" name="guardian_contact" value="<?= htmlspecialchars($student->guardian_contact) ?>" required></label><br>
    <label>Status:
      <select name="status" required>
        <option value="active" <?= $student->status == 'active' ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= $student->status == 'inactive' ? 'selected' : '' ?>>Inactive</option>
      </select>
    </label><br>
    <button type="submit">Save Changes</button>
  </form>
</body>

</html>
