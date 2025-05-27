<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guardian') {
  header('Location: ../auth/login.php');
  exit();
}

// submit-complaints-request.php
$xmlFile = __DIR__ . '/../../data/private/complaints-requests-user.xml';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: complaints-requests.php');
    exit;
}

$type = $_POST['type'] ?? '';
$date = $_POST['date'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if (empty($type) || empty($date) || empty($subject)) {
    die('Missing required fields.');
}

// Load or create XML file
if (file_exists($xmlFile)) {
    $xml = simplexml_load_file($xmlFile);
} else {
    $xml = new SimpleXMLElement('<complaints></complaints>');
}

// Generate new unique ID for complaint (max current ID + 1)
$maxId = 0;
foreach ($xml->complaint as $complaint) {
    $currId = (int)$complaint['id'];
    if ($currId > $maxId) {
        $maxId = $currId;
    }
}
$newId = $maxId + 1;

// Add new complaint node
$newComplaint = $xml->addChild('complaint');
$newComplaint->addAttribute('id', $newId);
$newComplaint->addChild('type', htmlspecialchars($type));
$newComplaint->addChild('subject', htmlspecialchars($subject));
$newComplaint->addChild('date', $date);
$newComplaint->addChild('status', 'Pending');  // default status on submission
$newComplaint->addChild('message', htmlspecialchars($message));

// Save back to file
$xml->asXML($xmlFile);

header('Location: complaints-requests.php');
exit;
