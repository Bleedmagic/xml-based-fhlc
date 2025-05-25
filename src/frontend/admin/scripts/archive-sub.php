<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  echo "Unauthorized access.";
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $xmlFile = __DIR__ . '/../../../data/private/complaints-requests.xml';

    if (!file_exists($xmlFile)) {
      echo json_encode(['success' => false, 'message' => 'Data file not found.']);
      exit;
    }

    $xml = simplexml_load_file($xmlFile);
    $found = false;

    foreach ($xml->submission as $submission) {
      if ((int)$submission->id === $id && strtolower((string)$submission->status) === 'open') {
        $submission->status = 'Closed';
        $found = true;
        break;
      }
    }

    if ($found) {
      $xml->asXML($xmlFile);
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'message' => 'Submission not found or already closed.']);
    }
  } else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
  }
} else {
  http_response_code(405);
  echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
