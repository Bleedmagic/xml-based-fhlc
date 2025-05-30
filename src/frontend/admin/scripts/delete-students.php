<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  echo 'Access denied.';
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/students.xml';
$id = $_GET['id'] ?? '';

if (!file_exists($xmlPath)) {
  http_response_code(404);
  echo 'XML file not found.';
  exit();
}

$xml = simplexml_load_file($xmlPath);
$found = false;

foreach ($xml->student as $index => $student) {
  if ((string)$student->id === $id) {
    $dom = dom_import_simplexml($student);
    $dom->parentNode->removeChild($dom);
    $xml->asXML($xmlPath);
    $found = true;
    break;
  }
}

if ($found) {
  echo 'success';
} else {
  http_response_code(404);
  echo 'Student not found.';
}
