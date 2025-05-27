<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/faculty.xml';
$id = $_GET['id'] ?? '';

if (!$id) {
  die('No teacher ID specified.');
}

if (!file_exists($xmlPath)) {
  die('XML file not found.');
}

$xml = simplexml_load_file($xmlPath);
$teacherToDelete = null;
$indexToDelete = -1;

foreach ($xml->teachers->teacher as $index => $teacher) {
  if ((string)$teacher->id === $id) {
    $teacherToDelete = $teacher;
    $indexToDelete = $index;
    break;
  }
}

if (!$teacherToDelete) {
  die('Teacher not found.');
}

// Remove the teacher node
$dom = dom_import_simplexml($teacherToDelete);
$dom->parentNode->removeChild($dom);

// Save changes to XML
$xml->asXML($xmlPath);

// Redirect to faculty list
header('Location: ../faculty.php');
exit();
