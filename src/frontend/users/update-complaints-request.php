<?php
// update-complaints-request.php
$xmlFile = __DIR__ . '/../../data/private/complaints-requests-user.xml';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: complaints-requests.php');
    exit;
}

$id = $_POST['id'] ?? '';
$type = $_POST['type'] ?? '';
$date = $_POST['date'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Basic validation (you can expand this)
if (empty($id) || empty($type) || empty($date) || empty($subject)) {
    die('Missing required fields.');
}

if (!file_exists($xmlFile)) {
    die('Data file not found.');
}

$xml = simplexml_load_file($xmlFile);
if ($xml === false) {
    die('Failed to load XML.');
}

$found = false;
foreach ($xml->complaint as $complaint) {
    if ((string)$complaint['id'] === (string)$id) {
        $complaint->type = $type;
        $complaint->date = $date;
        $complaint->subject = $subject;
        $complaint->message = $message;
        $complaint->status = 'Pending'; // Reset status on update if desired

        // Remove guardian node if exists
        if (isset($complaint->guardian)) {
            unset($complaint->guardian);
        }

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
