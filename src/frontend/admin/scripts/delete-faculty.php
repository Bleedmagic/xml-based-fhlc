<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/faculty.xml';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
  die('Invalid request.');
}

if (!file_exists($xmlPath)) {
  die('XML file not found.');
}

$xml = simplexml_load_file($xmlPath);
$teacherToDelete = null;

foreach ($xml->teachers->teacher as $teacher) {
  if ((string)$teacher->id === $_POST['id']) {
    $teacherToDelete = $teacher;
    break;
  }
}

if ($teacherToDelete) {
  $dom = dom_import_simplexml($teacherToDelete);
  $dom->parentNode->removeChild($dom);
  $xml->asXML($xmlPath);
}

header('Location: ../faculty.php');
exit();
