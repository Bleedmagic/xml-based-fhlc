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

foreach ($xml->student as $student) {
  if ((string)$student->id === $id) {
    $dom = dom_import_simplexml($student);
    $dom->parentNode->removeChild($dom);
    $xml->asXML($xmlPath);
    header('Location: ../students.php');
    exit();
  }
}

die('Student not found.');
