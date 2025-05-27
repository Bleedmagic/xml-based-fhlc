<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/faculty.xml';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (file_exists($xmlPath)) {
    $xml = simplexml_load_file($xmlPath);
  } else {
    // Create new XML structure if not exists
    $xml = new SimpleXMLElement('<faculty></faculty>');
  }

  // Ensure <teachers> exists
  if (!isset($xml->teachers)) {
    $xml->addChild('teachers');
  }

  // Generate a new ID based on existing teachers (optional)
  $lastId = 0;
  foreach ($xml->teachers->teacher as $teacher) {
    $currentId = intval(substr((string)$teacher->id, 1)); // assuming format 'T001'
    if ($currentId > $lastId) $lastId = $currentId;
  }
  $newId = 'T' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

  $newTeacher = $xml->teachers->addChild('teacher');
  $newTeacher->addChild('id', $newId);
  $newTeacher->addChild('name', htmlspecialchars($_POST['name']));
  $newTeacher->addChild('subject_handled', htmlspecialchars($_POST['subject_handled']));
  $newTeacher->addChild('grade_levels', htmlspecialchars($_POST['grade_levels']));
  $newTeacher->addChild('type', htmlspecialchars($_POST['type']));

  $xml->asXML($xmlPath);
  header('Location: ../faculty.php');
  exit();
}
?>

<form method="POST" action="">
  <label>Name: <input type="text" name="name" required></label><br>
  <label>Subjects Handled: <input type="text" name="subject_handled" required></label><br>
  <label>Grade Levels: <input type="text" name="grade_levels" required></label><br>
  <label>Type: <input type="text" name="type" required></label><br>
  <button type="submit">Add Faculty</button>
</form>
