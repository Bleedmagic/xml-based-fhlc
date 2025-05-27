<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guardian') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlFile = __DIR__ . '/../../data/private/complaints-requests-user.xml';

if (!isset($_GET['id'])) {
    header('Location: complaints-requests.php');
    exit;
}

$id = $_GET['id'];

if (!file_exists($xmlFile)) {
    die('Data file not found.');
}

$xml = simplexml_load_file($xmlFile);
if ($xml === false) {
    die('Failed to load XML file.');
}

$found = false;
foreach ($xml->complaint as $complaint) {
    if ((string)$complaint['id'] === (string)$id) {
        $complaint->status = 'Archived';
        $found = true;
        break;
    }
}

if (!$found) {
    die('Complaint not found.');
}

$xml->asXML($xmlFile);

header('Location: complaints-requests.php');
exit;
