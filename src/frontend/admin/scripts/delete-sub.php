<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['success' => false, 'message' => 'Unauthorized.']);
  exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
  http_response_code(405);
  echo json_encode(['success' => false, 'message' => 'Invalid request.']);
  exit();
}

$id      = (int)$_POST['id'];
$xmlFile = __DIR__ . '/../../../data/private/complaints-requests.xml';

// Load as DOM
$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput       = true;
if (! $dom->load($xmlFile)) {
  echo json_encode(['success' => false, 'message' => 'Failed to load XML.']);
  exit();
}

$xpath = new DOMXPath($dom);
// Find the <submission> whose <id> matches
$query = sprintf('//submissions/submission[id="%d"]', $id);
$nodes = $xpath->query($query);

if ($nodes->length === 0) {
  echo json_encode(['success' => false, 'message' => 'Submission not found.']);
  exit();
}

// Remove the first matched node
$node = $nodes->item(0);
$node->parentNode->removeChild($node);

// Save back to file
if ($dom->save($xmlFile) === false) {
  echo json_encode(['success' => false, 'message' => 'Failed to write XML.']);
  exit();
}

echo json_encode(['success' => true]);
