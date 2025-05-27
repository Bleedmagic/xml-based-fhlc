<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/grades-remarks.xml';

if (!isset($_GET['id'])) {
  header('Location: ../grades-remarks.php');
  exit();
}

$id = $_GET['id']; // Keep as string, do not cast

if (!file_exists($xmlPath)) {
  die('XML file not found.');
}

$xml = simplexml_load_file($xmlPath);
if ($xml === false) {
  die('Failed to parse XML file.');
}

// Find student node to delete
$nodeToRemove = null;
foreach ($xml->student as $student) {
  if ((string)$student->id === $id) {
    $nodeToRemove = $student;
    break;
  }
}

if ($nodeToRemove === null) {
  die('Student record not found.');
}

// Remove node reliably via DOM
$domNode = dom_import_simplexml($nodeToRemove);
$domNode->parentNode->removeChild($domNode);

// Save XML back
$xml->asXML($xmlPath);

header('Location: ../grades-remarks.php');
exit();
