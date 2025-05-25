<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin' || !isset($_SESSION['email'])) {
  http_response_code(403);
  echo json_encode(['error' => 'Unauthorized']);
  exit();
}

header('Content-Type: application/json');

$xmlFile = __DIR__ . '/../../../data/private/bookmarks.xml';
$userEmail = $_SESSION['email'];

// Load or create XML
if (!file_exists($xmlFile)) {
  $xml = new SimpleXMLElement('<bookmarks></bookmarks>');
  $xml->asXML($xmlFile);
}

$xml = simplexml_load_file($xmlFile);
if ($xml === false) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to load bookmarks']);
  exit();
}

// Find user node by email
$userNode = null;
foreach ($xml->user as $user) {
  if ((string)$user['email'] === $userEmail) {
    $userNode = $user;
    break;
  }
}

// If user node not found, create it
if ($userNode === null) {
  $userNode = $xml->addChild('user');
  $userNode->addAttribute('email', $userEmail);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $links = [];
  foreach ($userNode->link as $link) {
    $links[] = [
      'title' => (string)$link->title,
      'url' => (string)$link->url
    ];
  }
  echo json_encode($links);
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = json_decode(file_get_contents('php://input'), true);
  if (!$input || empty($input['title']) || empty($input['url'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit();
  }

  // Sanitize input
  $title = htmlspecialchars(trim($input['title']), ENT_QUOTES, 'UTF-8');
  $url = filter_var(trim($input['url']), FILTER_VALIDATE_URL);

  if (!$url) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid URL']);
    exit();
  }

  // Add new link to user's node
  $newLink = $userNode->addChild('link');
  $newLink->addChild('title', $title);
  $newLink->addChild('url', $url);

  // Save XML file with proper locking to prevent race conditions
  $dom = new DOMDocument('1.0', 'UTF-8');
  $dom->preserveWhiteSpace = false;
  $dom->formatOutput = true;
  $dom->loadXML($xml->asXML());

  if (file_put_contents($xmlFile, $dom->saveXML(), LOCK_EX) === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save bookmark']);
    exit();
  }

  echo json_encode(['success' => true]);
  exit();
}

// If method not allowed
http_response_code(405);
echo json_encode(['error' => 'Method not allowed']);
exit();
