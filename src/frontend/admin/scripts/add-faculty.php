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
    $xml = new SimpleXMLElement('<faculty></faculty>');
  }

  if (!isset($xml->teachers)) {
    $xml->addChild('teachers');
  }

  // Generate new ID
  $lastId = 0;
  foreach ($xml->teachers->teacher as $teacher) {
    $currentId = intval(substr((string)$teacher->id, 1)); // 'T001' → 1
    if ($currentId > $lastId) {
      $lastId = $currentId;
    }
  }
  $newId = 'T' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

  $newTeacher = $xml->teachers->addChild('teacher');
  $newTeacher->addChild('id', $newId);
  $newTeacher->addChild('name', htmlspecialchars($_POST['name']));
  $newTeacher->addChild('subject_handled', htmlspecialchars($_POST['subject_handled']));
  $newTeacher->addChild('grade_levels', htmlspecialchars($_POST['grade_levels']));
  $newTeacher->addChild('type', htmlspecialchars($_POST['type']));

  $xml->asXML($xmlPath);
}

header('Location: ../faculty.php');
exit();
