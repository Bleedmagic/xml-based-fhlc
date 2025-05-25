<?php
header('Content-Type: application/json');

// Gatekeeper: ensure admin
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  echo json_encode(['success' => false, 'message' => 'Unauthorized']);
  exit;
}

$xmlPath = __DIR__ . '/../../../data/private/complaints-requests.xml';
if (!file_exists($xmlPath)) {
  echo json_encode(['success' => false, 'message' => 'Data file not found']);
  exit;
}

// Load XML
$xml = simplexml_load_file($xmlPath);
if ($xml === false) {
  echo json_encode(['success' => false, 'message' => 'Failed to parse XML']);
  exit;
}

$idToReopen = trim($_POST['id'] ?? '');
if ($idToReopen === '') {
  echo json_encode(['success' => false, 'message' => 'Missing ID']);
  exit;
}

// Find the <submission> with matching <id>
$found = false;
foreach ($xml->submission as $submission) {
  if ((string)$submission->id === $idToReopen) {
    // Change status back to “Open” (or whatever your workflow uses)
    $submission->status = 'Open';
    $found = true;
    break;
  }
}

if (!$found) {
  echo json_encode(['success' => false, 'message' => 'Submission not found']);
  exit;
}

// Save changes back to the file
if ($xml->asXML($xmlPath) === false) {
  echo json_encode(['success' => false, 'message' => 'Failed to write XML']);
  exit;
}

echo json_encode(['success' => true]);
