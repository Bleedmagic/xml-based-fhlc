<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  echo 'Unauthorized';
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/students.xml';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $guardian_name = trim($_POST['guardian_name']);
  $guardian_contact = trim($_POST['guardian_contact']);
  $status = trim($_POST['status']);

  if ($name && $guardian_name && $guardian_contact && $status) {
    if (file_exists($xmlPath)) {
      $xml = simplexml_load_file($xmlPath);
    } else {
      $xml = new SimpleXMLElement('<students></students>');
    }

    $newStudent = $xml->addChild('student');
    $newStudent->addChild('id', uniqid());
    $newStudent->addChild('name', $name);
    $newStudent->addChild('guardian_name', $guardian_name);
    $newStudent->addChild('guardian_contact', $guardian_contact);
    $newStudent->addChild('status', $status);

    $xml->asXML($xmlPath);
    echo 'success';
  } else {
    http_response_code(400);
    echo 'All fields are required.';
  }
}
