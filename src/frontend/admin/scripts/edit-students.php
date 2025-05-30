<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  exit('Unauthorized');
}

$xmlPath = __DIR__ . '/../../../data/private/students.xml';

if (!file_exists($xmlPath)) {
  http_response_code(404);
  exit('XML file not found.');
}

$xml = simplexml_load_file($xmlPath);
if (!$xml) {
  http_response_code(500);
  exit('Failed to parse XML file.');
}

$id = $_POST['id'] ?? '';
$student = null;

foreach ($xml->student as $s) {
  if ((string)$s->id === $id) {
    $student = $s;
    break;
  }
}

if (!$student) {
  http_response_code(404);
  exit('Student not found.');
}

$student->name = $_POST['name'] ?? $student->name;
$student->guardian_name = $_POST['guardian_name'] ?? $student->guardian_name;
$student->guardian_contact = $_POST['guardian_contact'] ?? $student->guardian_contact;
$student->status = $_POST['status'] ?? $student->status;

$xml->asXML($xmlPath);
exit('success');
