<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/faculty.xml';
if (!file_exists($xmlPath)) {
  die('XML file not found.');
}

$xml = simplexml_load_file($xmlPath);

// Ensure we have both ID and POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  $id = $_POST['id'];
  $teacher = null;
  foreach ($xml->teachers->teacher as $t) {
    if ((string)$t->id === $id) {
      $teacher = $t;
      break;
    }
  }

  if ($teacher) {
    $teacher->name            = htmlspecialchars($_POST['name']);
    $teacher->subject_handled = htmlspecialchars($_POST['subject_handled']);
    $teacher->grade_levels    = htmlspecialchars($_POST['grade_levels']);
    $teacher->type            = htmlspecialchars($_POST['type']);
    $xml->asXML($xmlPath);
  }
}

header('Location: ../faculty.php');
exit();
