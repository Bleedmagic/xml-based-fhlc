<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/sections.xml';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
  header('Location: ../sections.php');
  exit();
}

$id = (int)$_GET['id'];

if (!file_exists($xmlPath)) {
  die('XML file not found.');
}

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
if (!$dom->load($xmlPath)) {
  die('Failed to load XML file.');
}

$xpath = new DOMXPath($dom);
// XPath to find section with given id
$sectionNodes = $xpath->query("/sections/section[id='$id']");

if ($sectionNodes->length === 0) {
  die('Section not found.');
}

// Remove the node
$sectionNode = $sectionNodes->item(0);
$sectionNode->parentNode->removeChild($sectionNode);

// Save the XML back to file
$dom->save($xmlPath);

header('Location: ../sections.php');
exit();
