<?php
// Set content type for response (for testing/debugging)
// header('Content-Type: application/json');

$xmlFile = __DIR__ . '/../data/private/complaints-requests.xml';

// Validate POST input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $submittedBy = trim($_POST['submitted_by'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $subject = trim($_POST['subject'] ?? '');
  $message = trim($_POST['message'] ?? '');

  if (empty($submittedBy) || empty($email) || empty($subject) || empty($message)) {
    header('Location: contact.php?error=empty_fields');
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: contact.php?error=invalid_email');
    exit;
  }

  if (!file_exists($xmlFile)) {
    $xml = new SimpleXMLElement('<submissions></submissions>');
  } else {
    $xml = simplexml_load_file($xmlFile);
  }

  // Determine next ID
  $lastId = 0;
  foreach ($xml->submission as $entry) {
    $id = (int)$entry->id;
    if ($id > $lastId) {
      $lastId = $id;
    }
  }
  $nextId = $lastId + 1;

  // Add new submission
  $submission = $xml->addChild('submission');
  $submission->addChild('id', $nextId);
  $submission->addChild('via', 'Contact');
  $submission->addChild('submitted_by', htmlspecialchars($submittedBy));
  $submission->addChild('email', htmlspecialchars($email));
  $submission->addChild('submitted_date', date('Y-m-d'));
  $submission->addChild('subject', htmlspecialchars($subject));
  $submission->addChild('message', htmlspecialchars($message));
  $submission->addChild('status', 'Open');

  // Create directory if not exists
  $dir = dirname($xmlFile);
  if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
  }

  if (!$xml->asXML($xmlFile)) {
    // Save failed, redirect back with error or handle appropriately
    header('Location: contact.php?error=save_failed');
    exit;
  }

  // Save succeeded, redirect back to contact.php (or any page)
  header('Location: contact.php?success=1');
  exit;
} else {
  header('Location: contact.php?error=invalid_method');
  exit;
}
